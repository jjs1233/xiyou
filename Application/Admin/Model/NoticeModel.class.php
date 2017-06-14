<?php 
namespace Admin\Model;
use Think\Model;
class NoticeModel extends Model {
	protected $_auto = array(
			array('date','get_date',1,'callback'),
		);

	public function get_date(){
		return date('Y-m-d');
	}
 }

?>