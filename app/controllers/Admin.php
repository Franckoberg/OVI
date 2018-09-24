<?php 

/**
* 
*/
class Admin extends CI_Controller {

	/**
	* function __contruct()
	* @access public
	* @return void
	*
	*/
	function __construct() {
		parent::__construct();
		$this->load->model('Recherche_model','rechercher');
		$this->load->model('Admin_model','admin');
		$this->load->helper(array('form', 'url','date'));
		$this->load->library('form_validation');
	}

	/**
	* function index
	* @access public
	* @return void
	*
	*/
	function index() {
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	/**
	* function ativeUser()
	* @access public
	* @return void
	*
	*/
	function activeUser() {
		$id_user = $this->uri->segment(3);
		$this->admin->activeUser($id_user);
		$this->findPersonnel();
	}

	/**
	* function admregister()
	* @access public
	* @return void
	*
	*/
	function admregister() {
		$data = new stdClass();
		// liste de roles
		$roles = $this->listRoles();
		$data->roles = $roles;
		if ($this->input->post('admregister')) {
			if ( 
				!empty($this->input->post('inputNom')) AND !empty($this->input->post('inputPrenom')) AND
				!empty($this->input->post('inputFonction')) AND !empty($this->input->post('sexe_type')) AND
				!empty($this->input->post('mot_de_passe')) AND !empty($this->input->post('mot_de_passe_c')) 
			) {

				$password 	= $this->input->post('mot_de_passe');
				$confirm 	= $this->input->post('mot_de_passe_c');

				$nom 	= $this->input->post('inputNom');
				$prenom = $this->input->post('inputPrenom');
				$fonction = $this->input->post('inputFonction');
				$sexe = $this->input->post('sexe_type');

				$this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'required|min_length[8]');
				$this->form_validation->set_rules('mot_de_passe_c', 'mot de passe de confirmation', 'required|min_length[8]|matches[mot_de_passe]');

				$this->form_validation->set_rules('inputNom', 'nom', 'required|min_length[4]|max_length[18]|callback_ckeck_format_nom');
				$this->form_validation->set_rules('inputPrenom', 'prenom', 'required|min_length[4]|max_length[25]|callback_ckeck_format_prenom');
				$this->form_validation->set_rules('inputFonction', 'fonction', 'required|max_length[20]|callback_is_fonction_valide');
				$this->form_validation->set_rules('sexe_type', 'sexe', 'alpha|callback_ckeck_sexe_found');

				if($this->form_validation->run() == FALSE) {

					$this->load->view('templates/header');
					$this->load->view('admin/admin', $data);
					$this->load->view('templates/footer');
				} else {
					$code = $this->randomCode($nom,$prenom);
					$result = $this->admin->admregister($code,$nom, $prenom, $password, $fonction, $sexe);
					
					if ($result) {
						$_SESSION['flash']['success'] = 'Enregistrement reussie ';
						$this->findPersonnel();

						// $this->load->view('templates/header');
						// $this->load->view('admin/listUsers');
						// $this->load->view('templates/footer');
					} else { 
						$_SESSION['flash']['success'] = 'echec  ';
						$this->load->view('templates/header');
						$this->load->view('admin/admin', $data);
						$this->load->view('templates/footer');
					}
				}
			} else {
				$_SESSION['flash']['danger'] = 'Remplis tous les champs pour ajouter un personnel';
				$this->load->view('templates/header');
				$this->load->view('admin/admin', $data);
				$this->load->view('templates/footer');
			}
		} else {
			// $_SESSION['flash']['danger'] = 'Connection impossible!';
			$this->load->view('templates/header');
			$this->load->view('admin/admin', $data);
			$this->load->view('templates/footer');
		}
	}

	/**
	* function randomCode
	* @access public
	* @return void
	*
	* fonction permettant de genere une code sur la forme de : 2018BF-x
	* 2018 c'est l'anne 
	* B la premiere lettre du nom de la personne
	* F la premiere lettre du prenom de la personne
	* x represent un chiffre (1,2,3, ..)
	*
	* dateNomPrenom-id : 2018BF-0001
	*/
	function randomCode($nom,$prenom){
		$matricule = $this->admin->randomCode($nom,$prenom);
		if ($matricule) {
			$code 	= "";
			$nom 	= ucfirst(substr($nom, 0, 1));
			$prenom = ucfirst(substr($prenom, 0, 1));
			// formatage de date 
			$now  = time();
			$date = substr(unix_to_human($now), 0,4);
			
			$code .= $date.$nom.$prenom ;
			foreach ($matricule as $key) {
				$user_id = $key->id_user;
				$user_id++;
			}
			$code1 = array($code, $user_id);
			$userCode = implode("-", $code1);
		}	
		return $userCode;
	}

	/**
	* function check_if_email_exists
	* @access public 
	* @return bool
	*
	*/
    function check_if_email_exists($request_email){
    	$email_available = $this->admin->check_if_email_exists($request_email);
    	if ($email_available) {
    		return TRUE;
    	}else {
    		return FALSE ;
    	}    	
    }

    /**
	* function check_if_email_exists
	* @access public 
	* @return bool
	*
	*/
    function check_if_email_exists_($request_email){
    	$email_available = $this->admin->check_if_email_exists($request_email);
    	if ($email_available) {
    		return TRUE;
    	}else {
    		return FALSE ;
    	}    	
    }

	/**
	* function is_fonction_valide
	* @access public 
	* @return bool
	*
	*/
    function is_fonction_valide(){
		if ( (trim($this->input->post('inputFonction')) === 'Fonction') ){
			return FALSE;
		} else {
			return TRUE ;
		}
    }

    /**
	* function is_question_valid
	* @access public 
	* @return bool
	*
	*/
    function is_question_valid(){
		if ( trim($this->input->post('inputQuestion')) === 'Question secret'){
			return FALSE;
		} else {
			return TRUE ;
		}
    }

	/**
	* function ckeck_format_nom
	* @access public 
	* @param string $nom
	* @return bool
	*
	*/
    function ckeck_format_nom() {
    	$nom = $this->input->post('inputNom');
    	if (!preg_match('/^[a-zA-Z ]+$/', $nom)) {
    		return FALSE ;
    	}else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_prenom
	* @access public 
	* @param string $prenom
	* @return bool
	*
	*/
    function ckeck_format_prenom() {
    	$prenom = $this->input->post('inputPrenom');
    	if (!preg_match('/^[a-zA-Z ]+$/', $prenom)) {
    		return FALSE ;
    	}else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_telephone
	* @access public 
	* @param int $inputTelephone_ua
	* @return bool
	*
	*/
    function ckeck_format_telephone($inputTelephone_ua){
    	if (!preg_match('/^[0-9]+$/',trim($this->input->post('inputTelephone_ua')) )) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_telephone
	* @access public 
	* @param int $inputTelephone_p
	* @return bool
	*
	*/
    function ckeck_format_telephoneA($inputTelephone_p){
    	if (!preg_match('/^[0-9]+$/', trim($this->input->post('inputTelephone_p')) )) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_telephone
	* @access public 
	* @param int $inputTelephone_ub
	* @return bool
	*
	*/
    function ckeck_format_telephoneB($inputTelephone_ub){
    	if (!preg_match('/^[0-9]+$/', trim($this->input->post('inputTelephone_ub')) )) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_sexe_found
	* @access public 
	* @param string $sexe
	* @return bool
	*
	*/
    function ckeck_sexe_found($sexe){
    	if (empty(trim($this->input->post('sexe_type')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_goupesanguin_found
	* @access public 
	* @param char $groupe_sang
	* @return bool
	*
	*/
    function ckeck_goupesanguin_found($groupe_sang){
    	if (empty(trim($this->input->post('groupe_sang')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_sexe_found
	* @access public 
	* @param date $date_naiss
	* @return bool
	*
	*/
    function ckeck_date_naissance_found($date_naiss){
    	if (empty(trim($this->input->post('date_naiss')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function parametres
	* @access public
	* @return void
	*
	*/
	function parametres () {
		$data = new stdClass();
		// liste de roles
		$roles = $this->listRoles();
		$data->roles = $roles;

		// liste de classe
		// $classe = $this->findClasse();
		// $data->classe = $classe;

		if (trim($this->input->post('save'))) {
			if (!empty($this->input->post('inputNom')) AND !empty($this->input->post('inputDesc'))  ) {
				$nom = strToUpper(trim($this->input->post('inputNom')));
				$desc = trim($this->input->post('inputDesc'));

				$role = $this->admin->create_role($nom, $desc);

				$this->load->view('templates/header');
				$_SESSION['flash']['success'] = 'Vous avec ajouter un nouveau role.';
				$this->load->view('admin/admin', $data);
				$this->load->view('templates/footer');
			} else {
				$this->load->view('templates/header');
				$_SESSION['flash']['danger'] = 'Le nom est obligatroire pour ajouter un role';
				$this->load->view('admin/admin', $data);
				$this->load->view('templates/footer');
			}
		} else {			
			$this->load->view('templates/header');
			$this->load->view('admin/admin', $data);
			$this->load->view('templates/footer');
		}

		// $this->load->view('templates/header');
		// $this->load->view('admin/admin');
		// $this->load->view('templates/footer');
	}

	/**
	* function delete
	* @access public
	* @return void
	*
	*/
	function deleteRole() {
		$data  = new stdClass();
		$roles = $this->listRoles();
		$data->roles = $roles;
		// $id = $_GET['id'];
		$id_role = htmlspecialchars(trim($this->uri->segment(3)));
		$this->admin->delete_role($id_role);

		// $this->parametres();
		$this->load->view('templates/header');
		$_SESSION['flash']['success'] = 'La suppresion du role a reussie.';				
		$this->load->view('admin/admin', $data);
		$this->load->view('templates/footer');		
	}

	/**
	* function listRoles
	* @access public 
	* @return un tableau d'objet
	*
	**/
	function listRoles() {
		// $data = new stdClass();
		$roles = $this->admin->listRoles();
		return $roles;
	}

	/**
	* function updateRole
	* @access public
	* @return void
	*
	*/
	function updateRole() {
		$data = new stdClass();
		$roles = $this->listRoles();
		$data->roles = $roles;

		if (trim($this->input->post('update'))) {
			if (!empty($this->input->post('inputNom')) AND !empty($this->input->post('inputDesc'))  ) {
				$id_role = trim($this->input->post('id_role'));
				$nom = strToUpper(trim($this->input->post('inputNom')));
				$desc = trim($this->input->post('inputDesc'));

				$role = $this->admin->updateRole($nom, $desc, $id_role);

				$this->load->view('templates/header');
				$_SESSION['flash']['success'] = 'La modification du role a reussie.';				
				$this->load->view('admin/admin', $data);
				$this->load->view('templates/footer');

			} else {
				$this->load->view('templates/header');
				$_SESSION['flash']['danger'] = 'Le nom est obligatroire pour la mise a jour du role.';
				$this->load->view('admin/admin', $data);
				$this->load->view('templates/footer');
			}
		}
	}

	/**
	* function findPersonnel
	* @access public
	* @return void
	*
	*/
	function findPersonnel(){
		$data = new StdClass();
		$personnel = $this->admin->findPersonnel();

		$data->personnel = $personnel;

		$this->load->view('templates/header');
		$this->load->view('admin/listUsers', $data);
		$this->load->view('templates/footer');
	}

	/**
	* function findPersonnel
	* @access public
	* @return void
	*
	*/
	// function findPersonnelById(){
	// 	$data = new StdClass();
	// 	$personnel = $this->admin->findPersonnelById();

	// 	$data->personnel = $personnel;

	// 	$this->load->view('templates/header');
	// 	$this->load->view('admin/listUsers', $data);
	// 	$this->load->view('templates/footer');
	// }

	/**
	* function findadmin
	* @access public
	* @return void
	*
	*/
	function updateProfil(){
		$data = new stdClass();
		$id_user = $this->uri->segment(3);
		$personnel = $this->admin->findPersonnelById($id_user);
		$data->personnel = $personnel;

		$this->form_validation->set_message('inputNom', 'The {field} field can not be the word "test"');
		if($this->form_validation->run() === FALSE ){
			$this->load->view('templates/header');
			// $_SESSION['flash']['danger'] = 'Remplir tous les champs svp!';
			$this->load->view('admin/editUser', $data );
		} else { 
			if (trim($this->input->post('update'))) {
				if (  !empty(trim($this->input->post('matiere')))
					AND !empty(trim($this->input->post('inputNom'))) AND !empty(trim($this->input->post('inputPrenom')))
					AND !empty(trim($this->input->post('featsexe')))
					AND !empty(trim($this->input->post('featstat'))) AND !empty(trim($this->input->post('inputProfession'))) 
					AND !empty(trim($this->input->post('inputNif'))) AND !empty(trim($this->input->post('inputTelephone')))
					AND !empty(trim($this->input->post('inputAdresse'))) AND !empty(trim($this->input->post('inputEmail')))
					 ) {
					$matiere = trim($this->input->post('matiere'));
					$nom = trim($this->input->post('inputNom')); $prenom = trim($this->input->post('inputPrenom'));
					$date_naiss = trim($this->input->post('date_naiss')); $sexe = trim($this->input->post('featsexe'));
					$status = trim($this->input->post('featstat')); $profession = trim($this->input->post('inputProfession'));
					$nif = trim($this->input->post('inputNif')); $phone = trim($this->input->post('inputTelephone'));
					$adresse = trim($this->input->post('inputAdresse')); $email = trim($this->input->post('inputEmail'));
					// $roles = trim($this->input->post('roles'));

					// if ($pass !== $pass_c) {
					// 	$this->load->view('templates/header');
					// 	$_SESSION['flash']['danger'] = 'Les deux mot de passe doit etre identique';
					// 	$this->load->view('admin/editUser', $data );
					// } else {
						// $code = $this->randomCode($nom,$prenom);
						$result = $this->admin->updateProfil($nom,$prenom,$sexe,$matiere,$nif,$adresse,$email,$phone,$status,$profession, $id_user);
						if ($result) {
							$this->load->view('templates/header');
							$_SESSION['flash']['success'] = 'Mise a jour reussie';
							$this->load->view('admin/listpersonnel', $data );
						} else {
							$this->load->view('templates/header');
							$_SESSION['flash']['danger'] = 'Une erreur ce produit lors de l\'enregistrement re-essayer svp!';
							$this->load->view('admin/editUser', $data );
						}
					// }
				} else {
					$this->load->view('templates/header');
					$_SESSION['flash']['danger'] = 'Remplir tous les champs svp!';
					$this->load->view('admin/editUser', $data );
				}
			} else {
				$this->load->view('templates/header');
				$this->load->view('admin/editUser', $data );
			}
		}
	}

	/**
	* function deletePersonnel
	* @access public
	* return void
	*/
	function deletePersonnel() {
		$id_user = $this->uri->segment(3);
		$this->admin->deletePersonnel($id_user);

		$this->findPersonnel();
	}

	/**
	* function user_question
	* @access public
	* return void
	*/
	// function user_question() {
	// 	return $question = $this->admin->user_question();
	// }

	/**
	* function StatistiqueEtudiants
	* @access public
	* return void
	*/
	function StatistiqueEtudiants() {
		$data = new StdClass();
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			$inscrire = $this->admin->CompteurInscrit();
			$data->inscrire = $inscrire; 
			$this->load->view('templates/header');
			$this->load->view('admin/statistiqueEtudiants', $data);
			$this->load->view('templates/footer');
		}
	}

	/**
	* function search_x
	* @access public 
	* @return void
	*
	*/
	function search_x(){
		$data = new stdClass();	
		if ($_GET['search']) {
			$search = $_GET['search'];
			$fetch = $this->rechercher->search($search); // var_dump($fetch);
			
			$data->fetch = $fetch;
			$this->load->view('templates/header');
			$this->load->view('search', $data); 
		} else {
			redirect('index');
		}
	}
}
?>