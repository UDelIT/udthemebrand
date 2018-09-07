<?php
/**
  * Interface: UDTheme Branding Check Current User
  *
  * The purpose of this interface is to:
  * extend the plugin to allow developers to change capability checks
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/include
  * @author      Christopher Leonard - University of Delaware
  * @license     GPLv3
  * @link        https://bitbucket.org/itcssdev/udtheme-brand
  * @copyright   Copyright (c) 2012-2018 University of Delaware
  * @version     3.1.0
*/

interface udtbp_Current_User_Check{
  public function udtbp_check_current_user($current_user);
}
