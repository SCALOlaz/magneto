<?
function link_ufaq()
{
    global $phpbb_root_path, $phpEx, $template, $user;
    $user->add_lang('mods/info_acp_ufaq');
    $template->assign_vars(array(
        'U_UFAQ'    => append_sid("{$phpbb_root_path}u_faq.$phpEx")
    ));
}

$phpbb_hook->register(array('template', 'display'), 'link_ufaq');
?>