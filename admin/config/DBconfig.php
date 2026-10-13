<?php 
require_once dirname(__DIR__, 1).'/config/config.php'; 
require_once dirname(__DIR__, 2).'/config/DB.php'; 

class DBconfig extends DB{

    private $MainDB;

    public function __construct()
    {
      
        $config = new config();

        //Main Database connection
        // DB::setDBType('MYSQL');
        // DB::setDBName('savanigems');
        // DB::setDBUser('root');
        // DB::setDBHost('localhost');
        // DB::setDBPass('');
        // DB::setDBPort('3306');
        // DB::Connect();


        if($config->getServermode()=='dev')
        {
            // $Config_DBname='savanigems';
            // $Config_DBuser='root';
            // $Config_DBhost='localhost';
            // $Config_DBpassword='';
            // $Config_DBport='3306';

            // $Config_DBhost='localhost';
            // $Config_DBuser='iis';
            // $Config_DBpassword='Mysql@2023';
            // $Config_DBname='savanigems';
            // $Config_DBport='3307';
        }
        else if($config->getServermode()=='uat')
        {   
            $Config_DBname='instanceitsoluti_savanigems20';
            $Config_DBuser='instanceitsoluti_savaniusr2010';
            $Config_DBhost='160.153.253.162';
            $Config_DBpassword='xyQ1CT798g3L';
            $Config_DBport='3306';

        }
        else if($config->getServermode()=='prod')
        {
            // $Config_DBname='tradecvd_websitedb';
            // $Config_DBuser='tradecvd_websiteuser19';
            // $Config_DBhost='localhost';
            // $Config_DBpassword='XucZPW0KOZef';
            // $Config_DBport='3306';

            $Config_DBname = 'tradecvd_websitedb';
            $Config_DBuser = 'root';
            $Config_DBhost = '127.0.0.1';
            $Config_DBpassword = '';
            $Config_DBport = '3306';
        }

        DB::setDBType('MYSQL');
        DB::setDBName($Config_DBname);
        DB::setDBUser($Config_DBuser);
        DB::setDBHost($Config_DBhost);
        DB::setDBPass($Config_DBpassword);
        DB::setDBPort($Config_DBport);
        DB::Connect();
    }

}




?>