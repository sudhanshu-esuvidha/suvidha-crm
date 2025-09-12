<?php  
defined('BASEPATH') or exit('No direct script access allowed');

function encrypt_decrypt($action, $string) {

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'e9b8b1596fbb58954dfae1fd6baa8dea';
    $secret_iv = 'e9b8b1596fbb58954dfae1fd6baa8dea';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}





function get_user($user_id)
{
    $CI =& get_instance();
     $query = $CI->db->query("select * from users where id=$user_id ");
     $row=$query->row();
     return $row;  
}


function get_all_list($table, $where = '')
{
    $CI =& get_instance();

    // Get current user's id from session
    $parent_id = $CI->session->userdata('user_info')->id ?? null;

    // If table is 'users', automatically add parent_id condition
    if ($table === 'users' && $parent_id) {
        if ($where) {
            // Check if $where already has 'WHERE'
            if (stripos(trim($where), 'where') === 0) {
                $where .= " AND parent_id=" . intval($parent_id);
            } else {
                $where .= " WHERE parent_id=" . intval($parent_id);
            }
        } else {
            $where = "WHERE parent_id=" . intval($parent_id);
        }
    }

    $query = $CI->db->query("SELECT * FROM $table $where");
    return $query->result();
}

function get_row($table,$where='')
{
     $CI =& get_instance();
     $query = $CI->db->query("select * from $table $where ");  
         return $query->row(); 
}
function get_row_column($table,$column,$condition="")
{
    $CI =& get_instance();
     $query = $CI->db->query("select ".$column." from $table $condition ");  
     $result=$query->row();
     return $result->$column;
}

function get_total_of_table($table,$where="")
{
     $CI =& get_instance();
     $query = $CI->db->query("select count(id) as total from ".$table." ".$where);
     $row=$query->row();
     return $row->total;
}
 function get_site_title()
{
    echo "STEP Up CRM";
}
