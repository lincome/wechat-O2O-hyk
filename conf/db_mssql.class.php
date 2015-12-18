<?php
    require_once("db_mssql.php");   //引入配置常量文件
    date_default_timezone_set(TIMEZONE); 
     
    /**
     * 类名：DB
     * 说明：数据库操作类
     */
    class DB
    {
        public $host;            //服务器
        public $username;        //数据库用户名
        public $password;        //数据密码
        public $dbname;          //数据库名
        public $conn;            //数据库连接变量
         
        /**
         * DB类构造函数
         */
        public function DB($host=DB_HOST ,$username=DB_USER,$password=DB_PASSWORD,$dbname=DB_NAME)
        {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
             
        }
        /**
         * 打开数据库连接
         */
        public function open()
        {
            $this->conn = mssql_connect($this->host,$this->username,$this->password);
            mssql_select_db($this->dbname);
            mssql_query("SET CHARACTER SET utf8");
        }
        /**
         * 关闭数据连接
         */
        public function close()
        {
            mssql_close($this->conn);
        }
    }
?>