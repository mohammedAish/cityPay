<?php
class ACL{
	private static $roleAccessList=array();
	private static $currentUserRole="";	
	private static $grade="";
	private static $runtimePermission=array();
	static function AddRuntimePermission($uri){
		$uri=strtolower($uri);
		$uri=str_replace("_", "-", $uri);
		self::$runtimePermission[]=$uri;
	}
	static function hasInRuntimePermission($uri){
		$uri=strtolower($uri);
		$uri=str_replace("_", "-", $uri);
		return  in_array($uri, self::$runtimePermission);
	}
	static function isSupperAdminUser(){
	    if(Mapp_user::HasAdminSession()){
	        $adminData=GetAdminData();
	        return $adminData->IsSuperUser();
	    }
	}
	static function HasPermission($uri=""){	 
	    $ci=get_instance();
		if(!empty($uri)){
			$uri=strtolower($uri);
			$uri=str_replace("_", "-", $uri);
		}
		if(self::hasInRuntimePermission($uri)){
			return true;
		}
		$pageid=$ci->router->get_route_unique_id($uri);
		$allpageid=$ci->router->get_route_all_method_unique_id();
		$allindexid=$ci->router->get_route_unique_id($uri."/index");
		$type=$ci->session->GetCurrentUserType();		
		if(empty(self::$roleaccesslist) && !empty($type)){
			if($type=="AD"){
				$adminData=Mapp_user::GetAdminData();
				if(!empty($adminData)){
					self::$roleAccessList=$adminData->RoleAccess;
					self::$currentUserRole=$adminData->role;
					self::$grade=$adminData->grade;
				}
			}
			if(self::$grade==0){
				return true;
			}elseif(in_array($pageid, self::$roleAccessList)|| in_array($allpageid, self::$roleAccessList)|| in_array($allindexid, self::$roleAccessList)){
				return true;
			}			
		}
		return false;
	}
    static function HasPermissionByPageId($pageid=""){
        $ci=get_instance();
        $type=$ci->session->GetCurrentUserType();
        if(empty(self::$roleaccesslist) && !empty($type)){
            if($type=="AD"){
                $adminData=Mapp_user::GetAdminData();
                if(!empty($adminData)){
                    self::$roleAccessList=$adminData->RoleAccess;
                    self::$currentUserRole=$adminData->role;
                    self::$grade=$adminData->grade;
                }
            }
            if(self::$grade==0){
                return true;
            }elseif(in_array($pageid, self::$roleAccessList)){
                return true;
            }
        }
        return false;
    }
    static function HasAddonActionPermission($action=""){
        $ci=get_instance();
        if(!empty($uri)){
            $uri=strtolower($uri);
            $uri=str_replace("_", "-", $uri);
        }
        if(self::hasInRuntimePermission($uri)){
            return true;
        }
        $pageid=$ci->router->get_route_unique_id($uri);
        $allpageid=$ci->router->get_route_all_method_unique_id();
        $allindexid=$ci->router->get_route_unique_id($uri."/index");
        $type=$ci->session->GetCurrentUserType();
        if(empty(self::$roleaccesslist) && !empty($type)){
            if($type=="AD"){
                $adminData=Mapp_user::GetAdminData();
                if(!empty($adminData)){
                    self::$roleAccessList=$adminData->RoleAccess;
                    self::$currentUserRole=$adminData->role;
                    self::$grade=$adminData->grade;
                }
            }
            if(self::$grade==0){
                return true;
            }elseif(in_array($pageid, self::$roleAccessList)|| in_array($allpageid, self::$roleAccessList)|| in_array($allindexid, self::$roleAccessList)){
                return true;
            }
        }
        return false;
    }
	
	
}