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
	public function addCompany($data)
	{
		$this->table = 'mt_company';
		return $this->store($data);
	}

	public function getCompanyData($param = null, $many = FALSE, $order_by = 'company_id', $order = 'DESC')
	{
		$this->table = 'mt_company';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function updateCompany($data, $param)
	{
		$this->table = 'mt_company';
		return $this->modify($data, $param);
	}

	public function delCompany($param)
	{
		$this->table = 'mt_company';
		return $this->remove($param);
	}


	//Segments
	public function addSegment($data)
	{
		$this->table = 'mt_segment';
		return $this->store($data);
	}

	public function getSegmentData($param = null, $many = FALSE, $order_by = 'segment_id', $order = 'DESC')
	{
		$this->table = 'mt_segment';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function updateSegment($data, $param)
	{
		$this->table = 'mt_segment';
		return $this->modify($data, $param);
	}

	public function delSegment($param)
	{
		$this->table = 'mt_segment';
		return $this->remove($param);
	}

	//cycles
	public function addCycle($data)
	{
		$this->table = 'mt_cycle';
		return $this->store($data);
	}

	public function getCycleData($param = null, $many = FALSE, $order_by = 'cycle_id', $order = 'DESC')
	{
		$this->table = 'mt_cycle';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function getCycles($param = null, $many = FALSE, $order = 'DESC', $order_by = 'mt_cycle.cycle_id')
	{

		$this->db->select('mt_cycle.*, mt_company.company_name, mt_segment.segment_name');

		$this->db->join('mt_company', 'mt_company.company_id = mt_cycle.company_id', 'inner');
		$this->db->join('mt_segment', 'mt_segment.segment_id = mt_cycle.segment_id', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('mt_cycle');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}

	public function updateCycle($data, $param)
	{
		$this->table = 'mt_cycle';
		return $this->modify($data, $param);
	}

	public function delCycle($param)
	{
		$this->table = 'mt_cycle';
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

	//checklist2
	public function addChecklist2($data)
	{
		$this->table = 'tbl_checklists_2';
		return $this->store($data);
	}

	public function getChecklist2Data($param = null, $many = FALSE, $order_by = 'checklist_id', $order = 'DESC')
	{
		$this->table = 'tbl_checklists_2';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function getChecklists2($param = null, $many = FALSE, $order = 'DESC', $order_by = 'tbl_checklists_2.checklist_id')
	{

		$this->db->select('tbl_checklists_2.*, mt_company.company_name, mt_segment.segment_name, mt_cycle.cycle_name');

		$this->db->join('mt_cycle', 'mt_cycle.cycle_id = tbl_checklists_2.cycle_id', 'inner');
		$this->db->join('mt_company', 'mt_company.company_id = tbl_checklists_2.company_id', 'inner');
		$this->db->join('mt_segment', 'mt_segment.segment_id = tbl_checklists_2.segment_id', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('tbl_checklists_2');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}

	public function updateChecklist2($data, $param)
	{
		$this->table = 'tbl_checklists_2';
		return $this->modify($data, $param);
	}

	public function delChecklist2($param)
	{
		$this->table = 'tbl_checklists_2';
		return $this->remove($param);
	}


	//checklist billing
	public function addChecklistBilling($data)
	{
		$this->table = 'checklist_billing';
		return $this->store($data);
	}

	public function getChecklistBillingData($param = null, $many = FALSE, $order_by = 'checklist_b_id', $order = 'DESC')
	{
		$this->table = 'checklist_billing';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function getChecklistsBilling($param = null, $many = FALSE, $order = 'DESC', $order_by = 'checklist_billing.checklist_b_id')
	{

		$this->db->select('checklist_billing.*, mt_company.company_name, mt_segment.segment_name, mt_cycle.cycle_name');

		$this->db->join('mt_cycle', 'mt_cycle.cycle_id = checklist_billing.cycle_id', 'inner');
		$this->db->join('mt_company', 'mt_company.company_id = checklist_billing.company_id', 'inner');
		$this->db->join('mt_segment', 'mt_segment.segment_id = checklist_billing.segment_id', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('checklist_billing');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}



	public function getChecklistsBillingOrder($param = null, $many = FALSE, $order = 'DESC', $order_by = 'checklist_billing.checklist_b_id', $group_by = 'checklist_billing.unique_id')
	{

		$this->db->select('checklist_billing.*, mt_company.company_name, mt_segment.segment_name, mt_cycle.cycle_name');

		$this->db->join('mt_cycle', 'mt_cycle.cycle_id = checklist_billing.cycle_id', 'inner');
		$this->db->join('mt_company', 'mt_company.company_id = checklist_billing.company_id', 'inner');
		$this->db->join('mt_segment', 'mt_segment.segment_id = checklist_billing.segment_id', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->group_by($group_by);

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('checklist_billing');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}


	public function updateChecklistBilling($data, $param)
	{
		$this->table = 'checklist_billing';
		return $this->modify($data, $param);
	}

	public function delChecklistBilling($param)
	{
		$this->table = 'checklist_billing';
		return $this->remove($param);
	}

	//checklist2 billing
	public function addChecklist2Billing($data)
	{
		$this->table = 'checklist2_billing';
		return $this->store($data);
	}

	public function getChecklist2BillingData($param = null, $many = FALSE, $order_by = 'checklist_b_id', $order = 'DESC')
	{
		$this->table = 'checklist2_billing';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function getChecklists2Billing($param = null, $many = FALSE, $order = 'DESC', $order_by = 'checklist2_billing.checklist_b_id')
	{

		$this->db->select('checklist2_billing.*, mt_company.company_name, mt_segment.segment_name, mt_cycle.cycle_name');

		$this->db->join('mt_cycle', 'mt_cycle.cycle_id = checklist2_billing.cycle_id', 'inner');
		$this->db->join('mt_company', 'mt_company.company_id = checklist2_billing.company_id', 'inner');
		$this->db->join('mt_segment', 'mt_segment.segment_id = checklist2_billing.segment_id', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('checklist2_billing');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}



	public function getChecklists2BillingOrder($param = null, $many = FALSE, $order = 'DESC', $order_by = 'checklist2_billing.checklist_b_id', $group_by = 'checklist2_billing.unique_id')
	{

		$this->db->select('checklist2_billing.*, mt_company.company_name, mt_segment.segment_name, mt_cycle.cycle_name');

		$this->db->join('mt_cycle', 'mt_cycle.cycle_id = checklist2_billing.cycle_id', 'inner');
		$this->db->join('mt_company', 'mt_company.company_id = checklist2_billing.company_id', 'inner');
		$this->db->join('mt_segment', 'mt_segment.segment_id = checklist2_billing.segment_id', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->group_by($group_by);

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('checklist2_billing');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}


	public function updateChecklist2Billing($data, $param)
	{
		$this->table = 'checklist2_billing';
		return $this->modify($data, $param);
	}

	public function delChecklist2Billing($param)
	{
		$this->table = 'checklist2_billing';
		return $this->remove($param);
	}
}
