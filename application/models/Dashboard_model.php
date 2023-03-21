<?php
ini_set('mysql.connect_timeout', 15000);
ini_set('default_socket_timeout', 15000);
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_top($id){
        $this->db->select('*');
        $this->db->where('top_negara_id', $id);
        return $this->db->get('ref_top_page')->row();
    }

	function update_top_page($id, $data){
        $this->db->where('top_negara_id', $id);
        return $this->db->update('ref_top_page', $data);
    }

	function get_activity($id){
        $this->db->select('*');
        $this->db->where('activity_negara_id', $id);
        return $this->db->get('ref_activity')->row();
    }

    function update_activity($id, $data){
        $this->db->where('activity_negara_id', $id);
        return $this->db->update('ref_activity', $data);
    }


	function get_news($id){
        $this->db->select('*');
        $this->db->where('news_negara_id', $id);
        return $this->db->get('ref_news')->row();
    }

    function update_news($id, $data){
        $this->db->where('news_negara_id', $id);
        return $this->db->update('ref_news', $data);
    }

	function get_product($id){
        $this->db->select('*');
        $this->db->where('product_negara_id', $id);
        return $this->db->get('ref_product')->row();
    }

    function update_product($id, $data){
        $this->db->where('product_negara_id', $id);
        return $this->db->update('ref_product', $data);
    }

	function get_photos($data){
        $this->db->select('*');
        $this->db->where('foto_negara_id', $data);
        return $this->db->get('ref_negara_foto')->result();
    }

	function get_news_photos($id){
        $this->db->select('*');
        $this->db->where('news_foto_news_id', $id);
        return $this->db->get('ta_news_foto')->result();
    }

	function get_activities_photos($id){
        $this->db->select('*');
        $this->db->where('activities_foto_activities_id', $id);
        return $this->db->get('ta_activities_foto')->result();
    }

	function get_product_photos($id){
        $this->db->select('*');
        $this->db->where('product_foto_product_id', $id);
        return $this->db->get('ta_products_foto')->result();
    }

	function get_video($id){
        $this->db->select('*');
        $this->db->where('video_negara_id', $id);
        return $this->db->get('ref_video')->row();
    }

    function update_video($id, $data){
        $this->db->where('video_negara_id', $id);
        return $this->db->update('ref_video', $data);
    }

	function update_footer($id, $data){
        $this->db->where('negara_id', $id);
        return $this->db->update('ref_negara', $data);
    }

    function get_footer($id){
        $this->db->select('*');
        $this->db->where('negara_id', $id);
        return $this->db->get('ref_negara')->row();
    }

	function add_new_news($data){
        return $this->db->insert('ta_news', $data);
    }

	function add_new_activities($data){
        return $this->db->insert('ta_activities', $data);
    }

	function add_new_product($data){
        return $this->db->insert('ta_products', $data);
    }

	function get_news_negara($id){
        $this->db->select('*');
        $this->db->where('news_negara_id', $id);
		$this->db->where('news_aktif', 1);
		$this->db->order_by('news_created_at', 'desc');
        return $this->db->get('ta_news')->result();
    }

	function get_product_negara($id){
        $this->db->select('*');
        $this->db->where('product_negara_id', $id);
		$this->db->where('product_aktif', 1);
		$this->db->order_by('product_created_at', 'desc');
        return $this->db->get('ta_products')->result();
    }

	function get_activities_negara($id){
        $this->db->select('*');
		$this->db->join('ref_cat_activities', 'cat_id=activities_cat_id', 'left');
        $this->db->where('activities_negara_id', $id);
		$this->db->where('activities_aktif', 1);
		$this->db->order_by('activities_created_at', 'desc');
        return $this->db->get('ta_activities')->result();
    }

	function update_news_negara($id, $data){
        $this->db->where('news_id', $id);
        return $this->db->update('ta_news', $data);
    }

	function update_activities_negara($id, $data){
        $this->db->where('activities_id', $id);
        return $this->db->update('ta_activities', $data);
    }

	function update_product_negara($id, $data){
        $this->db->where('product_id', $id);
        return $this->db->update('ta_products', $data);
    }

	function get_news_negara_row($id){
        $this->db->select('*');
        $this->db->where('news_id', $id);
		$this->db->where('news_aktif', 1);
        return $this->db->get('ta_news')->row();
    }

	function get_activities_negara_row($id){
        $this->db->select('*');
		$this->db->join('ref_cat_activities', 'cat_id=activities_cat_id', 'left');
        $this->db->where('activities_id', $id);
		$this->db->where('activities_aktif', 1);
        return $this->db->get('ta_activities')->row();
    }

	function get_product_negara_row($id){
        $this->db->select('*');
        $this->db->where('product_id', $id);
		$this->db->where('product_aktif', 1);
        return $this->db->get('ta_products')->row();
    }

}
