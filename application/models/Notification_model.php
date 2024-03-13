<?php
class Notification_model extends CI_Model {

   
    // For admin notifications
    public function create_admin_notification($message, $admin_id) {
        $data = array(
            'message' => $message,
            'status' => 'unread',
            'admin_id' => $admin_id,
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('admin_notifications', $data);
    }

    public function get_unread_admin_notifications($admin_id) {
        //$this->db->where('admin_id', $admin_id);
        $this->db->where('userid', $admin_id);
        $this->db->where('status', 'unread');
        $this->db->order_by('id', 'desc'); // Change 'notification_date' to the actual column you want to sort by
        $query = $this->db->get('announcement_notification');
        return $query->result();
    }
    public function get_unread_notifications($admin_id) {
        //$this->db->where('userid', $admin_id);
        $this->db->where('status', 'unread');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('notification');
        return $query->result();
    }
    //count admin
     public function get_admin_notifications_count($admin_id) {
          $this->db->where('userid', $admin_id);
        $this->db->where('status', 'unread');
        return $this->db->count_all_results('notification');
       // return $this->db->count_all_results('announcement');
      }
      public function get_notifications_count($admin_id, $table_name) {
        //$this->db->where('admin_id', $admin_id);
        
        $this->db->where('userid', $admin_id);
        $this->db->where('status', 'unread');
        return $this->db->count_all_results($table_name);
    }
 
      public function get_notifications_count1($admin_id, $table_name) {
        //$this->db->where('admin_id', $admin_id);

        $this->db->where('status', 'unread');
        return $this->db->count_all_results($table_name);
    }
 

    public function mark_notification_as_read($notification_id, $table_name) {
        $data = array('status' => 'read');
        $this->db->where('id', $notification_id);
        return $this->db->update($table_name, $data);
    } 
    public function All_mark_notification_as_read($table_name,$userid) {
        $data = array('status' => 'read');
        $this->db->where('status', 'unread');
        $this->db->where('id', $userid);
        return $this->db->update($table_name, $data);
    }
   
}
?>
