<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Auth_model extends MY_Model
{


	function __construct()
	{
		$this->table = 'users';
		$this->primary_key = 'user_id';
	}

	//users
	public function addUser($data)
	{
		$this->table = 'users';
		return $this->store($data);
	}
	public function getUserData($param = null, $many = FALSE)
	{
		$this->table = 'users';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'user_id', $order = 'DESC', FALSE);
		} else {
			return $this->get_many();
		}
	}


	public function updateUser($data, $param)
	{
		$this->table = 'users';
		return $this->modify($data, $param);
	}
	public function delUser($param)
	{
		$this->table = 'users';
		return $this->remove($param);
	}

	//Company
	public function addCNFEntry($data)
	{
		$this->table = 'mt_cnf_entry';
		return $this->store($data);
	}

	public function getCNFEntryData($param = null, $many = FALSE, $order_by = 'entry_id', $order = 'DESC')
	{
		$this->table = 'mt_cnf_entry';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function updateCNFEntry($data, $param)
	{
		$this->table = 'mt_cnf_entry';
		return $this->modify($data, $param);
	}

	public function delCNFEntry($param)
	{
		$this->table = 'mt_cnf_entry';
		return $this->remove($param);
	}





	//checklist
	public function addChecklist($data)
	{
		$this->table = 'tbl_checklists';
		return $this->store($data);
	}

	public function getChecklistData($param = null, $many = FALSE, $order_by = 'checklist_id', $order = 'DESC')
	{
		$this->table = 'tbl_checklists';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function getChecklists($param = null, $many = FALSE, $order = 'DESC', $order_by = 'tbl_checklists.checklist_id')
	{

		$this->db->select('tbl_checklists.*, mt_company.company_name, mt_segment.segment_name, mt_cycle.cycle_name');

		$this->db->join('mt_cycle', 'mt_cycle.cycle_id = tbl_checklists.cycle_id', 'inner');
		$this->db->join('mt_company', 'mt_company.company_id = tbl_checklists.company_id', 'inner');
		$this->db->join('mt_segment', 'mt_segment.segment_id = tbl_checklists.segment_id', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('tbl_checklists');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}

	public function updateChecklist($data, $param)
	{
		$this->table = 'tbl_checklists';
		return $this->modify($data, $param);
	}

	public function delChecklist($param)
	{
		$this->table = 'tbl_checklists';
		return $this->remove($param);
	}

	
}
