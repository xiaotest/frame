<?php
require_once dirname(__DIR__).'/common/includes.php';

class Request
{
    //类库属性
    private $db = null;
    private $log = null;

    public function __construct()
    {
        $this->Request();
    }

    public function Request()
    {
        $this->db= new mysql(WxPayConfig::sqlHOST,WxPayConfig::mysqlname, WxPayConfig::mysqlpaw, WxPayConfig::dbname);
        $this->log = new  CLogFileHandler(dirname(__DIR__)."/log/" . date('Y-m-d') . '.log');
        Log::Init($this->log, 15);
    }

    //请求分发处理
    public function index()
    {
        $method = isset($_REQUEST['method']) ? $_REQUEST['method']:'not_method';
        switch($method){
            case 'submitOrderInfo'://提交订单
                $this->submitOrderInfo();
                break;
            case 'queryOrder'://查询订单
                $this->queryOrder();
                break;
             default:
                echo "请求方法出错";
        }
    }

    //提交订单
    public function submitOrderInfo(){
        var_dump($_REQUEST);
//        $sqlstr = "select  *  from  wadragon_10000.orders";
//        $this->db->query($sqlstr);
//        $result= $this->db->fetchArray(MYSQL_ASSOC);
//        dump($result);
//        Log::DEBUG('res '.json_encode($result));
     }

    //查询订单
    public function queryOrder()
    {
        $sqlstr = "select  *  from  wadragon_10000.orders Limit 1";
        $this->db->query($sqlstr);
        $result= $this->db->fetchArray(MYSQL_ASSOC);
        dump($result);
        Log::DEBUG('res '.json_encode($result));
    }
}

//请求类库文件处理
$request=new Request();
$request->index();