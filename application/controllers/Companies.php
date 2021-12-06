<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Companies extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'Companies';
			$custdata = $this->am->getCompanyData(array('status' => 1), TRUE);
			if (!empty($custdata)) {
				foreach ($custdata as $key => $value) {
					$this->data['comp_data'][] = array(
						'dtime'  => $value->added_dtime,
						'compid'  => encode_url($value->company_id),
						'name'  => $value->company_name,
						'status'  => $value->status,
						'added_by'  => $value->added_by,
						'edited_dtime'  => ($value->edited_dtime != '') ? $value->edited_dtime : 'NA'
					);
				}

				//print_obj($this->data['comp_data']);die;

			} else {
				$this->data['comp_data'] = '';
			}
			$this->load->view('companies/vw_company_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCheckDuplicateComp()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$name = xss_clean($this->input->post('name'));

				$if_exists = $this->am->getCompanyData(array('company_name' => $name), FALSE);
				if ($if_exists) {
					$return['if_exists'] = 1;
				} else {
					$return['if_exists'] = 0;
				}

				header('Content-Type: application/json');

				echo json_encode($return);
			} else {
				//exit('No direct script access allowed');
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onGetCompEdit()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Edit Company';
			$company_id = decode_url(xss_clean($this->uri->segment(2)));
			$chkdata = array(
				'company_id'  => $company_id
			);
			$getdata = $this->am->getCompanyData($chkdata, FALSE);
			if ($getdata) {
				$this->data['comp_data'] = array(
					'dtime'  => $getdata->added_dtime,
					'compid'  => encode_url($getdata->company_id),
					'name'  => $getdata->company_name,
					'status'  => $getdata->status,
					'added_by'  => $getdata->added_by,
					'edited_dtime'  => ($getdata->edited_dtime != '') ? $getdata->edited_dtime : 'NA'
				);
				//print_obj($this->data['comp_data']);die;
				$this->load->view('companies/vw_company_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onChangeComp()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Company';
			$company_id = decode_url(xss_clean($this->input->post('comp_id')));
			$chkdata = array('company_id'  => $company_id);

			$name = xss_clean($this->input->post('name'));

			// print_obj($upd_userdata);die;

			$custdata = $this->am->getCompanyData($chkdata, FALSE);
			if (!empty($custdata)) {
				//update

				$upd_data = array(
					'company_name'  => $name,
					'edited_dtime'  => dtime,
					'edited_by'  => $this->session->userdata('userid')
				);

				$upduser = $this->am->updateCompany($upd_data, $chkdata);
				if ($upduser) {
					$this->data['update_success'] = 'Successfully updated.';
					//list

					$dataUpd = $this->am->getCompanyData($chkdata, FALSE);
					$this->data['comp_data'] = array(
						'dtime'  => $dataUpd->added_dtime,
						'compid'  => encode_url($dataUpd->company_id),
						'name'  => $dataUpd->company_name,
						'status'  => $dataUpd->status,
						'added_by'  => $dataUpd->added_by,
						'edited_dtime'  => ($dataUpd->edited_dtime != '') ? $dataUpd->edited_dtime : 'NA'
					);
				} else {
					$this->data['update_failure'] = 'Not updated!';
				}

				$this->load->view('companies/vw_company_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onCreateCompView()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Company';
			$this->load->view('companies/vw_company_add', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCreateComp()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$this->form_validation->set_rules('name', 'Comapany Name', 'trim|required|xss_clean|htmlentities');

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['added'] = 'rule_error';
				} else {

					$name = xss_clean($this->input->post('name'));
					$chkdata = array('company_name'  => $name);
					$getdata = $this->am->getCompanyData($chkdata, FALSE);

					if (!$getdata) {

						//add
						$ins_data = array(
							'company_name'  => $name,
							'added_dtime'  => dtime,
							'added_by'  => $this->session->userdata('userid')
						);
						// print_obj($ins_data);die;
						$addcust = $this->am->addCompany($ins_data);

						if ($addcust) {
							$return['added'] = 'success';
						} else {
							$return['added'] = 'failure';
						}
					} else {
						$return['added'] = 'already_exists';
					}
				}

				header('Content-Type: application/json');
				echo json_encode($return);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onDeleteComp()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$company_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getCompanyData(array('company_id'  => $company_id), FALSE);

				if (!empty($getdata)) {
					//del
					$del = $this->am->delCompany(array('company_id' => $company_id));

					if ($del) {
						$return['deleted'] = 'success';
					} else {
						$return['deleted'] = 'failure';
					}
					// }
					// else{
					// 	$return['deleted'] = 'billed';
					// }



				} else {
					$return['deleted'] = 'not_exists';
				}

				header('Content-Type: application/json');
				echo json_encode($return);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}
}
