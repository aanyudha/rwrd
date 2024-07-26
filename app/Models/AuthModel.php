<?php namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends BaseModel
{
    protected $builder;
    protected $builderRoles;
    protected $builderMstMember;

    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('users');
        $this->builderRoles = $this->db->table('roles_permissions');
        $this->builderMstMember = $this->db->table('mst_member');
    }

    //input values
    public function inputValues()
    {
        return [
            'email' => inputPost('email'),
            'password' => inputPost('password')
        ];
    }
	//input values Spc
    public function inputValuesSpc()
    {
        return [
            'id_member' => inputPost('id_member'),
            'fullname' => inputPost('fullname'),
            'name_on_card' => inputPost('namecard'),
            'tanggal_lahir' => formatDateOnly(inputPost('dob')),
            'id_negara' => inputPost('nationality'),
            'alamat' => inputPost('mailingaddr'),
            'kota' => inputPost('city'),
            'propinsi' => inputPost('province'),
            'kode_pos' => inputPost('postalcode'),
            'telepon' => inputPost('hometelp'),
            'handphone' => inputPost('mobilenomer'),
            'email' => inputPost('email'),
            'username' => inputPost('email'),
            'password' => inputPost('password')
        ];
    }

    //login
    public function login()
    {
        $data = $this->inputValues();
        $user = $this->getUserByEmail($data['email']);
        if (!empty($user)) {
            if (!password_verify($data['password'], $user->password)) {
                return false;
            }
            if ($user->status == 0) {
                return 'banned';
            }
            $this->loginUser($user);
            return "success";
        }
        return false;
    }

    //login user
    public function loginUser($user)
    {
        if (!empty($user)) {
            $userData = array(
                'tr_ses_id' => $user->id,
                'tr_ses_role' => $user->role,
                'tr_ses_pass' => md5($user->password ?? '')
            );
            $this->session->set($userData);
        }
    }
	
	//login m
    public function mlogin()
    {
        $data = $this->inputValues();
        $muser = $this->getUserByEmailm($data['email']);
        $muserId = $this->getUserByIdem($data['email']);

        if (!empty($muser)||!empty($muserId)) {
			if(empty($muser->email)||$muser->email == null){ 
				if (!password_verify($data['password'], $muserId->password)) {
					return false;
				}
					if ($muserId->status == 'Non Aktif') {
					return 'banned';
				}
				$this->mloginUser($muserId);
				return "success";
			}elseif(empty($muserId->email)||$muserId->email == null){
				if (!password_verify($data['password'], $muser->password)) {
					return false;
				}
				if ($muser->status == 'Non Aktif') {
					return 'banned';
				}
				$this->mloginUser($muser);
				return "success";
			}
        }
        return false;
    }

    //login user m
    public function mloginUser($muser)
    {
        if (!empty($muser)) {
            $userData = array(
                'tr_ses_id' => $muser->id_member,
                'tr_ses_role' => 'user', //'tr_ses_role' => $user->role, asli
                'tr_ses_pass' => md5($muser->password ?? '')
            );
            $this->session->set($userData);
        }
    }

    //login with facebook
    public function loginWithFacebook($fbUser)
    {
        if (!empty($fbUser)) {
            $user = $this->getUserByEmail($fbUser->email);
            if (empty($user)) {
                if (empty($fbUser->name)) {
                    $fbUser->name = 'user-' . uniqid();
                }
                $username = $this->generateUniqueUsername($fbUser->name);
                $slug = $this->generateUniqueSlug($username);
                $data = [
                    'facebook_id' => $fbUser->id,
                    'email' => $fbUser->email,
                    'email_status' => 1,
                    'token' => generateToken(),
                    'role' => 'user',
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => '',
                    'user_type' => 'facebook',
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                if (!empty($data['email'])) {
                    $this->builder->insert($data);
                    $user = $this->getUserByEmail($fbUser->email);
                    if (!empty($user)) {
                        $this->downloadSocialProfileImage($user, $fbUser->pictureURL);
                    }
                }
            }
            if (!empty($user)) {
                if ($user->status == 0) {
                    return false;
                }
                $this->loginUser($user);
            }
        }
        return false;
    }

    //login with google
    public function loginWithGoogle($gUser)
    {
        if (!empty($gUser)) {
            $user = $this->getUserByEmail($gUser->email);
            if (empty($user)) {
                if (empty($gUser->name)) {
                    $gUser->name = 'user-' . uniqid();
                }
                $username = $this->generateUniqueUsername($gUser->name);
                $slug = $this->generateUniqueSlug($username);
                $data = [
                    'google_id' => $gUser->id,
                    'email' => $gUser->email,
                    'email_status' => 1,
                    'token' => generateToken(),
                    'role' => 'user',
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => '',
                    'user_type' => 'google',
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                if (!empty($data['email'])) {
                    $this->builder->insert($data);
                    $user = $this->getUserByEmail($gUser->email);
                    if (!empty($user)) {
                        $this->downloadSocialProfileImage($user, $gUser->avatar);
                    }
                }
            }
            if (!empty($user)) {
                if ($user->status == 0) {
                    return false;
                }
                $this->loginUser($user);
            }
        }
    }

    //login with vk
    public function loginWithVK($vkUser)
    {
        if (!empty($vkUser)) {
            $user = $this->getUserByEmail($vkUser->email);
            if (empty($user)) {
                if (empty($vkUser->name)) {
                    $vkUser->name = 'user-' . uniqid();
                }
                $username = $this->generateUniqueUsername($vkUser->name);
                $slug = $this->generateUniqueSlug($username);
                $data = [
                    'vk_id' => $vkUser->id,
                    'email' => $vkUser->email,
                    'email_status' => 1,
                    'token' => generateToken(),
                    'role' => 'user',
                    'username' => $username,
                    'slug' => $slug,
                    'avatar' => '',
                    'user_type' => 'vkontakte',
                    'last_seen' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                if (!empty($data['email'])) {
                    $this->builder->insert($data);
                    $user = $this->getUserByEmail($vkUser->email);
                    if (!empty($user)) {
                        $this->downloadSocialProfileImage($user, $vkUser->avatar);
                    }
                }
            }
            if (!empty($user)) {
                if ($user->status == 0) {
                    return false;
                }
                //login
                $this->loginUser($user);
            }
        }
    }

    //download social profile image
    public function downloadSocialProfileImage($user, $imgURL)
    {
        if (!empty($user) && !empty($imgURL)) {
            $uploadModel = new UploadModel();
            $tempPath = $uploadModel->downloadTempImage($imgURL, 'jpg', 'profile_temp');
            if (!empty($tempPath) && file_exists($tempPath)) {
                $data['avatar'] = $uploadModel->uploadAvatar($user->id, $tempPath);
            }
            if (!empty($data) && !empty($data['avatar'])) {
                $this->builder->where('id', $user->id)->update($data);
            }
        }
    }

    //register
    public function register()
    {
        $data = $this->inputValues();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['user_type'] = 'registered';
        $data["slug"] = $this->generateUniqueSlug($data['username']);
        $data['status'] = 1;
        $data['token'] = generateToken();
        $data['role'] = 'user';
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($this->builder->insert($data)) {
            $id = $this->db->insertID();
            $user = $this->getUser($id);
            if ($this->generalSettings->email_verification == 1 && !empty($user)) {
                $data['email_status'] = 0;
                $emailModel = new EmailModel();
                $emailModel->sendEmailActivation($user->id);
            } else {
                $data['email_status'] = 1;
            }
            if (!empty($user)) {
                $this->loginUser($user);
            }
            return true;
        }
        return false;
    }
	
	public function memberID(){
		$id_hotel=0;
		$prefix=str_pad($id_hotel,2,"0",STR_PAD_LEFT).date("y");
		$query = $this->db->query("select ifnull(max(substring(id_member,5,4)),0)+1 as hasil from mst_member where substring(id_member,3,2)=?",array(date("y")))->getResult();
		$id_member=$prefix.str_pad($query[0]->hasil,4,"0",STR_PAD_LEFT);
		return $id_member;
	}
	
	
	//register
    public function registerSpc()
    {
        $data = $this->inputValuesSpc();
        $data['id_member'] = $this->memberID();
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['user_type'] = 'registered';
        //$data["slug"] = $this->generateUniqueSlug($data['username']);
        $data['status'] = 1;
        $data['token'] = generateToken();
        $data['role'] = 'user';
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($this->builderMstMember->insert($data)) {
            //$id = $this->db->insertID(); //kalo pake autoincreement bisa pake ini :D
            $id = $data['id_member']; //karena tidak pake autoincreement maka pake ini :)
            $member = $this->getMember($id);
			echo $member->id_member;
            if ($this->generalSettings->email_verification == 1 && !empty($member)) {
                $data['email_status'] = 0;
                $emailModel = new EmailModel();
                $emailModel->sendEmailActivationMember($member->id_member);
            } else {
                $data['email_status'] = 1;
            }
            if (!empty($member)) {
                $this->mloginUser($member);
            }
            return true;
        }
        return false;
    }

    //add user
    public function addUser()
    {
        $data = $this->inputValues();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['user_type'] = "registered";
        $data["slug"] = $this->generateUniqueSlug($data["username"]);
        $data['status'] = 1;
        $data['email_status'] = 1;
        $data['token'] = generateToken();
        $data['role'] = inputPost('role');
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->builder->insert($data);
    }

    //generate unique username
    public function generateUniqueUsername($username)
    {
        $newUsername = $username;
        if (!empty($this->getUserByUsername($newUsername))) {
            $newUsername = $username . " 1";
            if (!empty($this->getUserByUsername($newUsername))) {
                $newUsername = $username . " 2";
                if (!empty($this->getUserByUsername($newUsername))) {
                    $newUsername = $username . " 3";
                    if (!empty($this->getUserByUsername($newUsername))) {
                        $newUsername = $username . "-" . uniqid();
                    }
                }
            }
        }
        return $newUsername;
    }

    //generate uniqe slug
    public function generateUniqueSlug($username)
    {
        $slug = strSlug($username);
        if (!empty($this->getUserBySlug($slug))) {
            $slug = strSlug($username . "-1");
            if (!empty($this->getUserBySlug($slug))) {
                $slug = strSlug($username . "-2");
                if (!empty($this->getUserBySlug($slug))) {
                    $slug = strSlug($username . "-3");
                    if (!empty($this->getUserBySlug($slug))) {
                        $slug = strSlug($username . "-" . uniqid());
                    }
                }
            }
        }
        return $slug;
    }

    //logout
    public function logout()
    {
        $this->session->remove('tr_ses_id');
        $this->session->remove('tr_ses_role');
        $this->session->remove('tr_ses_pass');
    }

    //reset password
    public function resetPassword($token)
    {
        $user = $this->getUserByToken($token);
        if (!empty($user)) {
            $data = [
                'password' => password_hash(inputPost('password'), PASSWORD_DEFAULT),
                'token' => generateToken()
            ];
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }
	
	//reset password member
    public function resetPasswordMember($token)
    {
        $member = $this->getMemberByToken($token);
        if (!empty($member)) {
            $data = [
                'password' => password_hash(inputPost('password'), PASSWORD_DEFAULT),
                'token' => generateToken()
            ];
            return $this->builderMstMember->where('id_member', $member->id_member)->update($data);
        }
        return false;
    }

    //verify email
    public function verifyEmail($user)
    {
        if (!empty($user)) {
            $data = [
                'email_status' => 1,
                'token' => generateToken()
            ];
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }
	
	//verify email member
    public function verifyEmailMember($user)
    {
        if (!empty($user)) {
            $data = [
                'email_status' => 1,
                'reward_system_enabled' => 1,
                'token' => generateToken()
            ];
            return $this->builderMstMember->where('id_member', $user->id_member)->update($data);
        }
        return false;
    }
	
    //change user role
    public function changeUserRole($id, $role)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            return $this->builder->where('id', $user->id)->update(['role' => $role]);
        }
        return false;
    }

    //ban user
    public function banUser($user)
    {
        if (!empty($user)) {
            if ($user->status == 1) {
                $data = ['status' => 0];
            } else {
                $data = ['status' => 1];
            }
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }

    //get user by id
    public function getUser($id)
    {
        return $this->builder->where('id', cleanNumber($id))->get()->getRow();
    }
	//get Member by id
    public function getMember($id_member)
    {
        return $this->builderMstMember->where('id_member', cleanNumber($id_member))->get()->getRow();
    }
    //get user by email
    public function getUserByEmail($email)
    {
        return $this->builder->where('email', removeForbiddenCharacters($email))->get()->getRow();
    }
	//get member by email
    public function getMemberByEmail($email)
    {
        return $this->builderMstMember->where('email', removeForbiddenCharacters($email))->get()->getRow();
    }
	
	//get user by email m
    public function getUserByEmailm($email)
    {
        return $this->builderMstMember->where('email', removeForbiddenCharacters($email))->get()->getRow();
    }
	
	//get user by ID m
    public function getUserByIdem($idmember)
    {
        return $this->builderMstMember->where('id_member', removeForbiddenCharacters($idmember))->get()->getRow();
    }

    //get user by username
    public function getUserByUsername($username)
    {
        return $this->builder->where('username', removeForbiddenCharacters($username))->get()->getRow();
    }

    //get user by slug
    public function getUserBySlug($slug)
    {
        return $this->builder->where('slug', cleanSlug($slug))->get()->getRow();
    }

    //get user by token
    public function getUserByToken($token)
    {
        return $this->builder->where('token', removeForbiddenCharacters($token))->get()->getRow();
    }
	
	//get member by token
    public function getMemberByToken($token)
    {
        return $this->builderMstMember->where('token', removeForbiddenCharacters($token))->get()->getRow();
    }

    //get user by vk id
    public function getUserByVKId($vkId)
    {
        return $this->builder->where('vk_id', cleanStr($vkId))->get()->getRow();
    }

    //get users
    public function getUsers()
    {
        return $this->builder->where('role !=', 'admin')->get()->getResult();
    }

    //get all users
    public function getAllUsers()
    {
        return $this->builder->get()->getResult();
    }

    //get users have posts
    public function getUsersHavePosts()
    {
        return $this->builder->join('posts', 'posts.user_id = users.id')->select('users.*')->distinct()->get()->getResult();
    }

    //get users
    public function getAdministrators()
    {
        return $this->builder->where('role', 'admin')->get()->getResult();
    }

    //get active users
    public function getActiveUsers()
    {
        return $this->builder->where('status', 1)->orderBy('username')->get()->getResult();
    }

    //get latest users
    public function getLatestUsers()
    {
        return $this->builder->orderBy('id DESC')->get(6)->getResult();
    }

    //user count
    public function getUserCount()
    {
        return $this->builder->countAllResults();
    }

    //get roles and permissions
    public function getRolesPermissions()
    {
        return $this->builderRoles->get()->getResult();
    }

    //get role
    public function getRole($id)
    {
        return $this->builderRoles->where('id', cleanNumber($id))->get()->getRow();
    }

    //get role by key
    public function getRoleByKey($key)
    {
        return $this->builderRoles->where('role', cleanStr($key))->get()->getRow();
    }

    //update role
    public function editRole($id)
    {
        $role = $this->getRole($id);
        if (!empty($role)) {
            $data = [
                'admin_panel' => inputPost('admin_panel') == 1 ? 1 : 0,
                'add_post' => inputPost('add_post') == 1 ? 1 : 0,
                'manage_all_posts' => inputPost('manage_all_posts') == 1 ? 1 : 0,
                'navigation' => inputPost('navigation') == 1 ? 1 : 0,
                'pages' => inputPost('pages') == 1 ? 1 : 0,
                'rss_feeds' => inputPost('rss_feeds') == 1 ? 1 : 0,
                'categories' => inputPost('categories') == 1 ? 1 : 0,
                'widgets' => inputPost('widgets') == 1 ? 1 : 0,
                'polls' => inputPost('polls') == 1 ? 1 : 0,
                'gallery' => inputPost('gallery') == 1 ? 1 : 0,
                'comments_contact' => inputPost('comments_contact') == 1 ? 1 : 0,
                'newsletter' => inputPost('newsletter') == 1 ? 1 : 0,
                'ad_spaces' => inputPost('ad_spaces') == 1 ? 1 : 0,
                'users' => inputPost('users') == 1 ? 1 : 0,
                'seo_tools' => inputPost('seo_tools') == 1 ? 1 : 0,
                'settings' => inputPost('settings') == 1 ? 1 : 0,
            ];

            if ($role->role == 'admin') {
                $data = [];
            }
            $nameArray = array();
            foreach ($this->activeLanguages as $language) {
                $item = [
                    'lang_id' => $language->id,
                    'name' => inputPost('role_name_' . $language->id)
                ];
                array_push($nameArray, $item);
            }
            $data['role_name'] = serialize($nameArray);

            return $this->builderRoles->where('id', cleanNumber($id))->update($data);
        }
        return false;
    }

    //edit user
    public function editUser($id)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            $data = [
                'username' => inputPost('username'),
                'email' => inputPost('email'),
                'slug' => inputPost('slug'),
                'about_me' => inputPost('about_me'),
                'facebook_url' => inputPost('facebook_url'),
                'twitter_url' => inputPost('twitter_url'),
                'instagram_url' => inputPost('instagram_url'),
                'pinterest_url' => inputPost('pinterest_url'),
                'linkedin_url' => inputPost('linkedin_url'),
                'vk_url' => inputPost('vk_url'),
                'youtube_url' => inputPost('youtube_url'),
                'balance' => inputPost('balance'),
                'total_pageviews' => inputPost('total_pageviews')
            ];
            $uploadModel = new UploadModel();
            $file = $uploadModel->uploadTempFile('file', true);
            if (!empty($file) && !empty($file['path'])) {
                $data["avatar"] = $uploadModel->uploadAvatar($user->id, $file['path']);
                @unlink(FCPATH . $user->avatar);
                $uploadModel->deleteTempFile($file['path']);
            }
            return $this->builder->where('id', $user->id)->update($data);
        }
        return false;
    }

    //is slug unique
    public function isSlugUnique($slug, $id)
    {
        if (!empty($this->builder->where('id !=', cleanNumber($id))->where('slug', cleanSlug($slug))->get()->getRow())) {
            return true;
        }
        return false;
    }

    //check if email is unique
    public function isEmailUnique($email, $userId = 0)
    {
        $user = $this->getUserByEmail($email);
        if ($userId == 0) {
            if (!empty($user)) {
                return false;
            }
            return true;
        } else {
            if (!empty($user) && $user->id != $userId) {
                return false;
            }
            return true;
        }
    }
	
	//check if email is unique on mst member
    public function isEmailUniqueMember($email, $memberId = 0)
    {
        $member = $this->getMemberByEmail($email);
        if ($memberId == 0) {
            if (!empty($member)) {
                return false;
            }
            return true;
        } else {
            if (!empty($member) && $member->id != $memberId) {
                return false;
            }
            return true;
        }
    }

    //check if username is unique
    public function isUniqueUsername($username, $userId = 0)
    {
        $user = $this->getUserByUsername($username);
        if ($userId == 0) {
            if (!empty($user)) {
                return false;
            }
            return true;
        } else {
            if (!empty($user) && $user->id != $userId) {
                return false;
            }
            return true;
        }
    }

    //update last seen time
    public function updateLastSeen()
    {
        if (authCheck()) {
			if (checkUserPermission('admin_panel')){
				$this->builder->where('id', user()->id)->update(['last_seen' => date('Y-m-d H:i:s')]);
			}else{
				$this->builderMstMember->where('id_member', user()->id_member)->update(['last_seen' => date('Y-m-d H:i:s')]);
			}
        }
    }

    //get paginated users count
    public function getUsersCount()
    {
        $this->filterUsers();
        return $this->builder->where('role !=', 'admin')->countAllResults();
    }

    //get paginated users
    public function getUsersPaginated($perPage, $offset)
    {
        $this->filterUsers();
        return $this->builder->where('role !=', 'admin')->orderBy('created_at DESC')->limit($perPage, $offset)->get()->getResult();
    }

    //users filter
    public function filterUsers()
    {
        $q = inputGet('q');
        if (!empty($q)) {
            $this->builder->groupStart()->like('username', cleanStr($q))->orLike('email', cleanStr($q))->groupEnd();
        }
        $status = inputGet('status');
        if ($status != null && ($status == 1 || $status == 0)) {
            $this->builder->where('status', cleanNumber($status));
        }
        $role = inputGet('role');
        if (!empty($role)) {
            $this->builder->where('role', cleanStr($role));
        }
        $emailStatus = inputGet('email_status');
        if ($emailStatus != null && ($emailStatus == 1 || $emailStatus == 0)) {
            $this->builder->where('email_status', cleanNumber($emailStatus));
        }
        $rewardSystem = inputGet('reward_system');
        if ($rewardSystem != null && ($rewardSystem == 1 || $rewardSystem == 0)) {
            $this->builder->where('reward_system_enabled', cleanNumber($rewardSystem));
        }
    }

    //delete user
    public function deleteUser($id)
    {
        $user = $this->getUser($id);
        if (!empty($user)) {
            if (file_exists(FCPATH . $user->avatar)) {
                @unlink(FCPATH . $user->avatar);
            }
            $this->db->table('comments')->where('user_id', $user->id)->delete();
            $this->db->table('reading_lists')->where('user_id', $user->id)->delete();
            $posts = $this->db->table('posts')->where('user_id', $user->id)->get()->getResult();
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    $postAdminModel = new PostAdminModel();
                    $postAdminModel->deletePost($post->id);
                }
            }
            return $this->builder->where('id', $user->id)->delete();
        }
        return false;
    }
	
	 //check if table used
    public function chkTabelUsed($email)
    {
        $user = $this->getUserByEmail($email);
        $member = $this->getMemberByEmail($email);
		
            if (!empty($user)) {
				if(!empty($user) && $user != null){
					return $user->role;
				}else if(empty($user) && $user == null){
					return 'email nya tidak ada di DB user';
				}
            }else if(empty($user) && $member != null){
				return $member->role;
			}else if(empty($user) && $member == null){
				return 'email nya tidak ada di DB member';
			} else {
				return 0;
			}
	}

	//get paginated Members count
    public function getMembersCount()
    {
        $this->filterMembers();
        return $this->builderMstMember->where('role !=', 'admin')->where('role !=', 'moderator')->where('role !=', 'author')->countAllResults();
    }

    //get paginated Members
    public function getMembersPaginated($perPage, $offset)
    {
        $this->filterMembers();
        return $this->builderMstMember->where('role !=', 'admin')->where('role !=', 'moderator')->where('role !=', 'author')->orderBy('created_at DESC')->limit($perPage, $offset)->get()->getResult();
    }
	
	//ban member
    public function banMember($member)
    {
        if (!empty($member)) {
            if ($member->status == 'Aktif') {
                $data = ['status' => 'Non Aktif'];
            } else {
                $data = ['status' => 'Aktif'];
            }
            return $this->builderMstMember->where('id_member', $member->id_member)->update($data);
        }
        return false;
    }

    //Members filter
    public function filterMembers()
    {
        $q = inputGet('q');
        if (!empty($q)) {
            $this->builderMstMember->groupStart()->like('fullname', cleanStr($q))->orLike('email', cleanStr($q))->groupEnd();
        }
        $status = inputGet('status');
        if ($status != null && ($status == 'Aktif' || $status == 'Non Aktif')) {
            $this->builderMstMember->where('status', cleanStr($status));
        }
        $emailStatus = inputGet('email_status');
        if ($emailStatus != null && ($emailStatus == 1 || $emailStatus == 0)) {
            $this->builderMstMember->where('email_status', cleanNumber($emailStatus));
        }
        $rewardSystem = inputGet('reward_system');
        if ($rewardSystem != null && ($rewardSystem == 1 || $rewardSystem == 0)) {
            $this->builderMstMember->where('reward_system_enabled', cleanNumber($rewardSystem));
        }
    }

    //delete Member
    public function deleteMember($id)
    {
        $Member = $this->getMember($id);
        if (!empty($Member)) {
            if (file_exists(FCPATH . $Member->avatar)) {
                @unlink(FCPATH . $Member->avatar);
            }
            $this->db->table('comments')->where('id_member', $Member->id_member)->delete();
            $this->db->table('reading_lists')->where('id_member', $Member->id_member)->delete();
            $posts = $this->db->table('posts')->where('id_member', $Member->id_member)->get()->getResult();
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    $postAdminModel = new PostAdminModel();
                    $postAdminModel->deletePost($post->id);
                }
            }
            return $this->builderMstMember->where('id_member', $Member->id_member)->delete();
        }
        return false;
    }
}
