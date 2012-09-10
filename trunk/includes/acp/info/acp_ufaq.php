<?php
class acp_ufaq_info
{
    function module()
    {
        return array(
            'filename'    => 'acp_ufaq',
            'title'        => 'UFAQ',
            'version'    => '1.0.0',
            'modes'        => array(
                'index'        => array('title' => 'UFAQ_CATS', 'auth' => 'acl_a_', 'cat' => array('UFAQ')),
            ),
        );
    }

    function install()
    {
    }

    function uninstall()
    {
    }
}
?>