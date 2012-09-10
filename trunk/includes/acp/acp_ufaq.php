<?php
class acp_ufaq
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
      $form_name = 'acp_ufaq';
		add_form_key($form_name);
            $this->page_title = 'UFAQ_CATS';
            $this->tpl_name = 'acp_ufaq';
      $action = request_var('action', '');
      $id = (int) request_var('id', 0);

      switch($mode)
      {
         case 'index':
         if(!$action)
         {
         $sql = 'SELECT cat_id, cat_name, cat_count, cat_img
         		FROM ' . Q_CATS_TABLE . '
				ORDER BY cat_name ASC, cat_id ASC';
			$result = $db->sql_query($sql);

			while($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('cats',array(
					'CAT_NAME'		=> $row['cat_name'],
					'CAT_ID'		=> $row['cat_id'],
					'CAT_IMG'		=> $row['cat_img'] ? $phpbb_root_path.'images/ufaq/'.$row['cat_img'] : '',
					'CAT_COUNT'		=> $row['cat_count'],
					'U_CAT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $row['cat_id'],
					'U_EDIT'	=> $this->u_action . '&amp;action=edit&amp;id=' . $row['cat_id'],
					'U_DELETE'	=> $this->u_action . '&amp;action=del&amp;id=' . $row['cat_id'],
				)
				);
			}
		 }
		 elseif($action == 'add' || $action == 'edit')
		 {
			$sql = 'SELECT *
					FROM ' . Q_CATS_TABLE . '
					WHERE cat_id = '.$id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				// Assign already existing data
				$template->assign_vars(array(
					'S_EDIT'			=> $action == 'add' ? '1' : '2',
					'CAT_TITLE'			=> $row['cat_name'],
					'CAT_IMG'			=> $row['cat_img'],
					'U_CAT_IMG'		=> $row['cat_img'] ? $phpbb_root_path.'images/ufaq/'.$row['cat_img'] : '',
					'U_BACK'			=> $this->u_action,
					'U_ACTION'		=> $this->u_action . '&amp;id=' . $id,
				));

		 }
		 elseif($action == 'save')
		 {
			// Get all the data
				$cat_name = utf8_normalize_nfc(request_var('title', '', true));
				$cat_img = request_var('img', '', true);

				// Check the fields, we don't want empty ones
				if (!$cat_name)
				{
					trigger_error($user->lang['ACP_NO_CATNAME'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql_ary = array(
					'cat_name'				=> $cat_name,
					'cat_img'				=> $cat_img,
				);

				// Update or new cat?
				if ($id)
				{
					$sql = 'UPDATE ' . Q_CATS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . " WHERE cat_id = $id";
					$db->sql_query($sql);
					$message = $user->lang['CAT_UPDATED'].$cat_name;
					add_log('admin', 'CAT_UPDATED', $cat_name);
				}
				else
				{
					$sql = 'INSERT INTO ' . Q_CATS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
					$db->sql_query($sql);
					$message = $user->lang['CAT_ADDED'].$cat_name;
					add_log('admin', 'CAT_ADDED', $cat_name);
				}

				trigger_error($message . adm_back_link($this->u_action));
		 }
		 elseif($action == 'del')
		 {
		 		// Check if there is somethign to delete
				if (!$id)
				{
					trigger_error($user->lang['UFAQ_NO_CAT'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT cat_name
					FROM ' . Q_CATS_TABLE . '
					WHERE cat_id = ' . $id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult();

				if ($row['cat_name'])
				{
					$sql = 'DELETE FROM ' . Q_CATS_TABLE . "
						WHERE cat_id = $id";
					$db->sql_query($sql);

					$q_id = '';
				    $sql = 'SELECT q_id
							FROM ' . Q_QUESTION_TABLE . "
							WHERE q_parent = $id
							AND q_type = 1";
							$result = $db->sql_query($sql);

							while($q = $db->sql_fetchrow($result))
							{
								$q_id = $q['q_id'];
								$sql = 'DELETE FROM ' . Q_QUESTION_TABLE . "
									WHERE q_id = $q_id OR q_parent_q = $q_id";
								$db->sql_query($sql);
							}
							$db->sql_freeresult($result);

					add_log('admin', 'CAT_DELETED', $row['cat_name']);
					trigger_error($user->lang['CAT_DELETED'] . adm_back_link($this->u_action));
				}
				else
				{
					trigger_error($user->lang['UFAQ_NO_CAT'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
		 }
         break;
      }

   }
}
?>