<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication_model extends MY_Model
{

    /**
     * Update a user record with data not from POST
     *
     * @param  int     the user ID to update
     * @param  array   the data to update in the user table
     * @return bool
     */
    public function update_user_raw_data($the_user, $user_data = [])
    {
        $this->db->where('user_id', $the_user)
            ->update($this->db_table('user_table'), $user_data);
    }

    // --------------------------------------------------------------

    /**
     * Get data for a recovery
     *
     * @param   string  the email address
     * @return  mixed   either query data or FALSE
     */
    public function get_recovery_data($email)
    {
        $query = $this->db->select('u.user_id, u.email, u.banned')
            ->from($this->db_table('user_table') . ' u')
            ->where('LOWER( u.email ) =', strtolower($email))
            ->limit(1)
            ->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }

    // --------------------------------------------------------------

    /**
     * Get the user name, user salt, and hashed recovery code,
     * but only if the recovery code hasn't expired.
     *
     * @param  int  the user ID
     */
    public function get_recovery_verification_data($user_id)
    {
        $recovery_code_expiration = date('Y-m-d H:i:s', time() - config_item('recovery_code_expiration'));

        $query = $this->db->select('username, passwd_recovery_code')
            ->from($this->db_table('user_table'))
            ->where('user_id', $user_id)
            ->where('passwd_recovery_date >', $recovery_code_expiration)
            ->limit(1)
            ->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }

    // --------------------------------------------------------------

    /**
     * Validation and processing for password change during account recovery
     */
    public function recovery_password_change()
    {
        $this->load->library('form_validation');

        // Load form validation rules
        $this->load->model('examples/validation_callables');
        $this->form_validation->set_rules([
            [
                'field' => 'passwd',
                'label' => 'NEW PASSWORD',
                'rules' => [
                    'trim',
                    'required',
                    'matches[passwd_confirm]',
                    [
                        '_check_password_strength',
                        [$this->validation_callables, '_check_password_strength'],
                    ],
                ],
            ],
            [
                'field' => 'passwd_confirm',
                'label' => 'CONFIRM NEW PASSWORD',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'recovery_code',
            ],
            [
                'field' => 'user_identification',
            ],
        ]);

        if ($this->form_validation->run() !== false) {
            $this->load->vars(['validation_passed' => 1]);

            $this->_change_password(
                $this->input->post('passwd'),
                $this->input->post('passwd_confirm'),
                set_value('user_identification'),
                set_value('recovery_code')
            );
        } else {
            $this->load->vars(['validation_errors' => validation_errors()]);
        }
    }

    // --------------------------------------------------------------

    /**
     * Change a user's password
     *
     * @param  string  the new password
     * @param  string  the new password confirmed
     * @param  string  the user ID
     * @param  string  the password recovery code
     */
    protected function _change_password($password, $password2, $user_id, $recovery_code)
    {
        // User ID check
        if (isset($user_id) && $user_id !== false) {
            $query = $this->db->select('user_id')
                ->from($this->db_table('user_table'))
                ->where('user_id', $user_id)
                ->where('passwd_recovery_code', $recovery_code)
                ->get();

            // If above query indicates a match, change the password
            if ($query->num_rows() == 1) {
                $user_data = $query->row();

                $this->db->where('user_id', $user_data->user_id)
                    ->update(
                        $this->db_table('user_table'),
                        [
                            'passwd' => $this->authentication->hash_passwd($password),
                            'passwd_recovery_code' => null,
                            'passwd_recovery_date' => null,
                        ]
                    );
            }
        }
    }

    // --------------------------------------------------------------

    /**
     * Get an unused ID for user creation
     *
     * @return  int between 1200 and 4294967295
     */
    public function get_unused_id()
    {
        // Create a random user id between 1200 and 4,29,49,67,295
        $random_unique_int = 2147483648 + mt_rand(-2147482448, 2147483647);

        // Make sure the random user_id isn't already in use
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where('user_id', $random_unique_int);
        $query = $this->db->get();
        // ->get_where($this->db_table('user_table'));

        if ($query->num_rows() > 0) {
            $query->free_result();

            // If the random user_id is already in use, try again
            return $this->get_unused_id();
        }

        return $random_unique_int;
    }

    public function get_country_id($country_short_name)
    {
        $this->db->select('id');
        $this->db->from('m_countries');
        $this->db->where('shortname', $country_short_name);
        $result = $this->db->get()->row_array();
        return $result['id'];
    }

    public function get_user_data($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_user_profile_data($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_profile');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_auth_data($user_string, $role)
    {

        if ($role == 1) {
            $auth_level = 8;
        } else if ($role == 2) {
            $auth_level = 7;
        } else {
            $auth_level = 9;
        }
        // Selected user table data
        $selected_columns = [
            'username',
            'email',
            'auth_level',
            'passwd',
            'user_id',
            'banned',
            'last_login',
        ];

        // User table query
        $query = $this->db->select($selected_columns)
            ->from('users')
            //->join($this->db_table('user_address_table a'),'u.user_id=a.user_id','inner')
            //->join($this->db_table('user_phone_table pho'),'u.user_id=pho.user_id','inner')
            //->join($this->db_table('user_profile_table prof'),'u.user_id=prof.user_id','inner')
            //->where('LOWER( username ) =', strtolower($user_string))
            ->where('LOWER(email ) =', strtolower($user_string))
            ->or_where('LOWER(mobile ) =', strtolower($user_string))
            ->where('auth_level', $auth_level)
            ->limit(1)
            ->get();

        if ($query->num_rows() == 1) {
            $row = $query->row_array();

            // ACL is added
            /*$acl = $this->add_acl_to_auth_data( $row['user_id'] );
            $auth_profile =$this->add_profile_data($row['user_id']);
            $auth_address =$this->add_address_data($row['user_id']);
            $auth_contact =$this->add_contact_data($row['user_id']);

            //$acl_with_user_data = array_merge( $row, $acl );
            //return (object) array_merge( $acl_with_user_data, $profile_data );*/
            return (object) array_merge($row);
        }

        return false;
    }
}
