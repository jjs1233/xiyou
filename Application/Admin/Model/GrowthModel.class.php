<?php 
namespace Admin\Model;
use Think\Model;
class GrowthModel extends Model {

    protected $_auto = array ( 
        array('date','get_time',1,'callback')
    );

    public function get_time(){
    	return date('Y-m-d H:i:s');
    }
 }

?>