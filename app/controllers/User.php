<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	* function __contruct()
	* @access public
	* @return void
	*
	*/
	function __construct() {
		parent::__construct();
		$this->load->model('Admin_model','admin');
		$this->load->model('User_model','user');
		$this->load->model('Recherche_model','rechercher');
		$this->load->helper(array('form', 'url','date'));
		$this->load->library('form_validation');

		$this->load->library('Pdf_report');
	}

	function User() {
        parent::CI_Exceptions();
    }

	/**
	* function index()
	* @access public
	* @return void
	*
	*/
	public function index() {
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			$this->load->view('templates/header');
			$this->load->view('index');
			$this->load->view('templates/footer');
		}
	}

	/**
	* function login()
	* @access public
	* @return void
	*
	*/
	function login() {
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
		
			if ($this->input->post('signin')) {
				if (!empty($this->input->post('email')) AND !empty($this->input->post('password'))) {
					$email 	   	= trim($this->input->post('email'));
					$password 	= trim($this->input->post('password'));
					$result 	= $this->admin->login($email, $password);
					if ($result) {
						#connection depuis database
						$data = new StdClass();
						foreach ($result as $rows) {
							$sess_array = array(
								'id_user'		=> $rows->id_user,
								'fonction'		=> $rows->fonction,
								'email'			=> $rows->email,
								'nom'			=> $rows->nom,
								'foto'			=> $rows->foto,
								'is_logged_in ' => TRUE 
							);
							$this->session->set_userdata($sess_array);	
							$user = $this->session->userdata();

							$id_user = $rows->id_user;
							$personnel = $this->admin->findPersonnelById($id_user);
							$data->personnel = $personnel;

							if ( empty($rows->email) ) {
								$_SESSION['flash']['info'] = 'Veuillez completer vos informations pour continue.';
								// $this->load->view('templates/header');
								// $this->load->view('admin/formUser', $data);
								// $this->load->view('templates/footer');
								$this->updregister();
							} else {
								$_SESSION['flash']['success'] = 'Bienvenue<b> '.$rows->nom. ' </b>';
								$this->load->view('templates/header');
								$this->load->view('index');
								$this->load->view('templates/footer');
							}
						}

					} else {
						$_SESSION['flash']['danger'] = 'Désolé, ça n\'a pas fonctionné. <br /> Veuillez réessayer';
						$this->load->view('templates/header');
						$this->load->view('login');
						$this->load->view('templates/footer');					
					}
				} elseif (!empty($this->input->post('email')) AND empty($this->input->post('password'))) {
					$this->load->view('templates/header');
				    $_SESSION['flash']['danger'] = 'Désolé, ça n\'a pas fonctionné. <br /> Veuillez réessayer';
					$this->load->view('login');
					$this->load->view('templates/footer');
				} else {
					$_SESSION['flash']['danger'] = 'Veuillez remplis tous les champs ';
					$this->load->view('templates/header');
					$this->load->view('login');
					$this->load->view('templates/footer');
				}
			} else {
				$this->load->view('templates/header');
				$this->load->view('login');
				$this->load->view('templates/footer');
			}
		}
	}

	/**
	* function updregister()
	* @access public
	* @return void
	*
	*/
	function updregister() {
		$data = new stdClass();
		// // liste de roles
		$question = $this->user_question();
		$data->question = $question;

		// $data = new StdClass();
		// liste de personnel
		$id_user = $this->session->userdata('id_user');
		// $id_user = $rows->id_user;
		$personnel = $this->admin->findPersonnelById($id_user);
		$data->personnel = $personnel;

		if ($this->input->post('register')) {
			if ( 
				!empty($this->input->post('inputQuestion')) AND !empty($this->input->post('inputRepons')) AND
				!empty($this->input->post('inputNationalite')) AND // !empty($this->input->post('inputFonction')) AND
				!empty($this->input->post('date_naiss')) AND 
				// !empty($this->input->post('sexe_type')) AND !empty($this->input->post('inputEmail_p')) AND
				!empty($this->input->post('inputsante')) AND 
				// !empty($this->input->post('groupe_sang')) AND !empty($this->input->post('inputEmail_u'))
				// !empty($this->input->post('_status_matri'))AND !empty($this->input->post('inputTelephone_ub'))
				!empty($this->input->post('inputProfession')) AND !empty($this->input->post('inputCin_p')) AND
				!empty($this->input->post('inputTelephone_p')) AND !empty($this->input->post('inputAdresse_p')) AND
				!empty($this->input->post('inputpersapp')) AND
				!empty($this->input->post('inputTelephone_ua'))  AND
				!empty($this->input->post('inputAdresse_uc')) AND

				!empty($this->input->post('mot_de_passe')) AND !empty($this->input->post('mot_de_passe_c')) 
			) {
				$date_naiss = $this->input->post('date_naiss');
				if( $this->age_valid($date_naiss) ) {


					$code 	= $this->input->post('code');

					$inputQuestion 	= $this->input->post('inputQuestion');
					$inputRepons 	= $this->input->post('inputRepons');


					$password 	= $this->input->post('mot_de_passe');
					$confirm 	= $this->input->post('mot_de_passe_c');

					// $nom 	= $this->input->post('inputNom');
					// $prenom = $this->input->post('inputPrenom');
					$nationalite = $this->input->post('inputNationalite');
					// $fonction = $this->input->post('inputFonction');
					$date_naiss = $this->input->post('date_naiss');
					// $sexe = $this->input->post('sexe_type');
					$inputsante = $this->input->post('inputsante'); 
					$gsang = $this->input->post('groupe_sang');
					$status = $this->input->post('_status_matri');

					$profession = $this->input->post('inputProfession'); 
					$cin = $this->input->post('inputCin_p');
					$telephone = $this->input->post('inputTelephone_p'); 
					$adresse = $this->input->post('inputAdresse_p');
					$email = $this->input->post('inputEmail_p'); 
					$ugpersonne = $this->input->post('inputpersapp');
					$ugtelephone_a = $this->input->post('inputTelephone_ua');
					$ugtelephone_b = $this->input->post('inputTelephone_ub');
					$ugadresse = $this->input->post('inputAdresse_uc'); 
					$ugemail = $this->input->post('inputEmail_u');


					$this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'required|min_length[8]');
					$this->form_validation->set_rules('mot_de_passe_c', 'mot de passe de confirmation', 'required|min_length[8]|matches[mot_de_passe]');

					$this->form_validation->set_rules('inputRepons', 'votre reponse', 'required');
					$this->form_validation->set_rules('inputQuestion', 'question secret', 'required|callback_is_question_valid');
					// $this->form_validation->set_rules('inputPrenom', 'prenom', 'required|min_length[4]|max_length[25]|callback_ckeck_format_prenom');
					$this->form_validation->set_rules('inputNationalite', 'nationalite', 'required|min_length[6]|max_length[20]|alpha');
					// $this->form_validation->set_rules('inputFonction', 'fonction', 'required|max_length[20]|alpha|callback_is_fonction_valide');
					$this->form_validation->set_rules('date_naiss', 'date de naissance', 'required');
					// $this->form_validation->set_rules('sexe_type', 'sexe', 'alpha|callback_ckeck_sexe_found');
					$this->form_validation->set_rules('inputsante', 'probleme medical', 'alpha_numeric_spaces');
					$this->form_validation->set_rules('groupe_sang', 'groupe sanguin', 'callback_ckeck_goupesanguin_found');
					$this->form_validation->set_rules('_status_matri', 'status', 'required|alpha');
					$this->form_validation->set_rules('inputProfession', 'profession', 'required');
					$this->form_validation->set_rules('inputCin_p', 'cin', 'required|min_length[14]|max_length[22]');
					$this->form_validation->set_rules('inputTelephone_p', 'telephone', 'required|min_length[8]|callback_ckeck_format_telephoneA');
					$this->form_validation->set_rules('inputAdresse_p', 'adresse', 'required|min_length[6]');
					// $this->form_validation->set_rules('inputEmail_p', 'email', 'required|valid_email|callback_check_if_email_exists');
					$this->form_validation->set_rules('inputpersapp', 'nom', 'required|min_length[4]|callback_ckeck_format_nom_p');
					$this->form_validation->set_rules('inputTelephone_ua', 'telephone', 'required|min_length[8]|callback_ckeck_format_telephone');
					// $this->form_validation->set_rules('inputTelephone_ub', 'telephone', 'required|min_length[8]|callback_ckeck_format_telephoneB');
					$this->form_validation->set_rules('inputAdresse_uc', 'adresse', 'required|min_length[6]');
					// $this->form_validation->set_rules('inputEmail_u', 'email', 'required|valid_email|callback_check_if_email_exists_');

					if($this->form_validation->run() == FALSE) {

						$this->load->view('templates/header');
						$this->load->view('admin/formUser', $data);
						$this->load->view('templates/footer');
					} else {
						// $code = $this->randomCode($nom,$prenom);
						$result = $this->admin->updregister($code, $nationalite,$password, $date_naiss, $inputsante, $gsang, $status, $profession, $cin, $telephone, $adresse, $email, $ugpersonne, $ugtelephone_a, $ugtelephone_b, $ugadresse, $ugemail,$inputQuestion, $inputRepons);
						
						if ($result) {
							$_SESSION['flash']['success'] = 'Enregistrement reussie ';
							$this->findPersonnel();

							// $this->load->view('templates/header');
							// $this->load->view('admin/listUsers');
							// $this->load->view('templates/footer');
						} else { 
							$_SESSION['flash']['success'] = 'echec  ';
							$this->load->view('templates/header');
							$this->load->view('admin/formUser', $data);
							$this->load->view('templates/footer');
						}
					}
				} else {
					$_SESSION['flash']['danger'] = 'Vous devez avoir au moins 18ans pour inscrit  ';
					$this->load->view('templates/header');
					$this->load->view('admin/formUser', $data);
					$this->load->view('templates/footer');
				}

			} else {
				$_SESSION['flash']['danger'] = 'Remplis tous les champs';
				$this->load->view('templates/header');
				$this->load->view('admin/formUser', $data);
				$this->load->view('templates/footer');
			}
		} else {
			// $_SESSION['flash']['danger'] = 'Connection impossible!';
			$this->load->view('templates/header');
			$this->load->view('admin/formUser', $data);
			$this->load->view('templates/footer');
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
	* function ckeck_date_naissance_found
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
	* function ckeck_format_telephone
	* @access public 
	* @param int $inputTelephone_ua
	* @return bool
	*
	*/
    function ckeck_format_telephone($inputTelephone){
    	if (!preg_match('/^[0-9]+$/',trim($this->input->post('inputTelephone')) )) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_telephone_ua
	* @access public 
	* @param int $inputTelephone_ua
	* @return bool
	*
	*/
    function ckeck_format_telephone_ua($inputTelephone_ua){
    	if (!preg_match('/^[0-9]+$/',trim($this->input->post('inputTelephone_ua')) )) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_telephone_ub
	* @access public 
	* @param int $inputTelephone_ub
	* @return bool
	*
	*/
    function ckeck_format_telephone_ub($inputTelephone_ub){
    	if (!preg_match('/^[0-9]+$/',trim($this->input->post('inputTelephone_ub')) )) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_telephoneA
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
	* @param string $nom
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
	* function ckeck_format_nom_p
	* @access public 
	* @param string $nom
	* @return bool
	*
	*/
    function ckeck_format_nom_p() {
    	$nom = $this->input->post('inputpersapp');
    	if (!preg_match('/^[a-zA-Z ]+$/', $nom)) {
    		return FALSE ;
    	}else {
    		return TRUE ;
    	}
    }

    /**
	* function ckeck_format_nom_p_n
	* @access public 
	* @param string $nom
	* @return bool
	*
	*/
    function ckeck_format_nom_p_n() {
    	$nom = $this->input->post('inputPersNom');
    	if (!preg_match('/^[a-zA-Z ]+$/', $nom)) {
    		return FALSE ;
    	}else {
    		return TRUE ;
    	}
    }

	/**
	* function user_question
	* @access public
	* return void
	*/
	function user_question() {
		return $question = $this->admin->user_question();
	}

	function age_valid($date_naiss) {
	 	//On extrait l'anne dans la date choisir
        $d = substr($date_naiss, 0, 4);
        //On extrait l'anne dans la date du systeme
        $now  = time(); 
        $date = substr(unix_to_human($now), 0,4);
        //On fait la soustraction pour trouve l'age
        $age = $date - $d;
        if($age < 15) {
        	// echo 'Vous devez avoir au moins 14ans pour integre cette institution';
        	return false;
        } else {
        	return true;
    	}
	}

	/**
	* function logout()
	* @access public
	* @return void
	*
	*/
	function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		   		
		header('Location:login');
	}

	/**
	* function inscrir
	* @access public
	* @return void
	*
	*
	*/
	function inscrir() {
		$data = new stdClass();
		// liste de roles
		$question = $this->user_question();
		$data->question = $question;
		if ($this->input->post('save')) {
			if ( 
				!empty($this->input->post('inputNom')) AND !empty($this->input->post('inputPrenom')) AND
				!empty($this->input->post('sexe_type')) AND !empty($this->input->post('inputNationalite')) AND
				!empty($this->input->post('date_naiss')) AND !empty($this->input->post('inputLieuNaissance')) AND
				!empty($this->input->post('inputAdresse')) AND !empty($this->input->post('inputTelephone')) AND
				!empty($this->input->post('inputQuestion')) AND !empty($this->input->post('inputRepons')) AND
				!empty($this->input->post('_status_matri')) AND !empty($this->input->post('inputpersapp')) AND
				!empty($this->input->post('inputTelephone_ua')) AND !empty($this->input->post('inputAdresse_uc')) 
				// AND !empty($this->input->post('raisonetude'))

			) {
				$date_naiss = $this->input->post('date_naiss');
				if( $this->age_valid($date_naiss) ) {

					$inputNom 	= $this->input->post('inputNom');
					$inputPrenom 	= $this->input->post('inputPrenom');
					$sexe = $this->input->post('sexe_type');
					$inputNationalite = $this->input->post('inputNationalite');
					$date_naiss = $this->input->post('date_naiss');
					$inputLieuNaissance = $this->input->post('inputLieuNaissance');
					$inputAdresse = $this->input->post('inputAdresse');
					$inputTelephone = $this->input->post('inputTelephone');
					$inputQuestion = $this->input->post('inputQuestion');
					$inputRepons = $this->input->post('inputRepons');
					$_status_matri = $this->input->post('_status_matri');
					$inputpersapp = $this->input->post('inputpersapp');
					$inputTelephone_ua = $this->input->post('inputTelephone_ua');
					$inputAdresse_uc = $this->input->post('inputAdresse_uc');

					// $option_name = $this->input->post('option_name');

					$inputEmail = $this->input->post('inputEmail');		
					$inputsante = $this->input->post('inputsante');
					$groupe_sang = $this->input->post('groupe_sang');				
					$inputTelephone_ub = $this->input->post('inputTelephone_ub');				
					$inputEmail_u = $this->input->post('inputEmail_u');				

					$raisonetude = $this->input->post('raisonetude');
					$pub_ovi = $this->input->post('pub_ovi');
					$inputPersNom = $this->input->post('inputPersNom');

					$this->form_validation->set_rules('inputNom', 'nom', 'required|min_length[4]|max_length[18]|callback_ckeck_format_nom');
					$this->form_validation->set_rules('inputPrenom', 'prenom', 'required|min_length[4]|max_length[25]|callback_ckeck_format_prenom');
					$this->form_validation->set_rules('sexe_type', 'sexe', 'alpha|callback_ckeck_sexe_found');

					$this->form_validation->set_rules('inputRepons', 'votre reponse', 'required');
					$this->form_validation->set_rules('inputQuestion', 'question secret', 'required|callback_is_question_valid');

					$this->form_validation->set_rules('groupe_sang', 'groupe sanguin', 'callback_ckeck_goupesanguin_found');
					// $this->form_validation->set_rules('inputTelephone_p', 'telephone', 'required|min_length[8]|callback_ckeck_format_telephoneA');
					$this->form_validation->set_rules('inputNationalite', 'nationalite', 'required|min_length[6]|max_length[20]|alpha');
					$this->form_validation->set_rules('inputpersapp', 'nom', 'required|min_length[4]|callback_ckeck_format_nom_p');
					$this->form_validation->set_rules('inputPersNom', 'nom', 'min_length[4]|callback_ckeck_format_nom_p_n');
					$this->form_validation->set_rules('inputTelephone', 'telephone', 'required|min_length[8]|callback_ckeck_format_telephone');
					$this->form_validation->set_rules('inputTelephone_ua', 'telephone', 'required|min_length[8]|callback_ckeck_format_telephone_ua');
					// $this->form_validation->set_rules('inputTelephone_ub', 'telephone', 'min_length[8]|callback_ckeck_format_telephone_ub');
					$this->form_validation->set_rules('inputAdresse_uc', 'adresse', 'required|min_length[6]');
					$this->form_validation->set_rules('inputsante', 'probleme medical', 'alpha_numeric_spaces');
					$this->form_validation->set_rules('inputLieuNaissance', 'lieu de naissance', 'alpha_dash');
					$this->form_validation->set_rules('date_naiss', 'date de naissance', 'required');

					$this->form_validation->set_rules('inputEmail', 'email', 'valid_email');
					$this->form_validation->set_rules('inputEmail_u', 'email', 'valid_email');
					

					if($this->form_validation->run() == FALSE) {

						$this->load->view('templates/header');
						$this->load->view('etudiant/formEtudiant', $data);
						$this->load->view('templates/footer');
					} else {
						$code = $this->randomCode($inputNom,$inputPrenom);
						$result = $this->user->inscrir($code, $inputNom , $inputPrenom, $sexe, $inputNationalite, $date_naiss, $inputLieuNaissance, $inputAdresse, $inputTelephone, $inputQuestion, $inputRepons, $_status_matri, $inputpersapp, $inputTelephone_ua, $inputAdresse_uc, $inputEmail, $inputsante, $groupe_sang, $inputTelephone_ub, $inputEmail_u, $raisonetude,  $pub_ovi, $inputPersNom);
						
						if ($result) {
							$_SESSION['flash']['success'] = 'Enregistrement reussie ';
							$etu = $this->user->last_insert();
							$data->etu = $etu;
							// redirect('success',$data);
							$this->load->view('templates/header');
							$this->load->view('success', $data);
							$this->load->view('templates/footer');
						} else { 
							$_SESSION['flash']['success'] = 'echec  ';
							$this->load->view('templates/header');
							$this->load->view('etudiant/formEtudiant', $data);
							$this->load->view('templates/footer');

						}
					}
				} else {
					$_SESSION['flash']['danger'] = 'Vous devez avoir au moins 15 ans pour inscrire  ';
					$this->load->view('templates/header');
					$this->load->view('etudiant/formEtudiant', $data);
					$this->load->view('templates/footer');
				}
			} else {
				$_SESSION['flash']['danger'] = 'Remplis tous les champs svp!';
				$this->load->view('templates/header');
				$this->load->view('etudiant/formEtudiant', $data);
				$this->load->view('templates/footer');
			}
		} else {
			$this->load->view('templates/header');
			$this->load->view('etudiant/formEtudiant', $data);
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
		$matricule = $this->user->randomCode($nom,$prenom);
		if ($matricule) {
			$code 	= "";
			$nom 	= ucfirst(substr($nom, 0, 1));
			$prenom = ucfirst(substr($prenom, 0, 1));
			// formatage de date 
			$now  = time();
			$date = substr(unix_to_human($now), 0,4);
			
			$code .= $date.$nom.$prenom ;
			foreach ($matricule as $key) {
				$user_id = $key->id_etudiant;
				$user_id++;
			}
			$code1 = array($code, $user_id);
			$userCode = implode("-", $code1);
		}	
		return $userCode;
	}

	/**
	* function passforgot
	* @access public
	* @return void
	*
	*
	*/
	function passforgot() {
		if ($this->input->post('passforgot')) {
			if (!empty($this->input->post('code'))) {
				$code  	= $this->input->post('code');
				$result = $this->admin->passforgot($code);
				if ($result) {
					$data = new StdClass();
					$data->result = $result;
					$result1 = $this->admin->find_personnel_by_id_for_question($result[0]->id_user);
					$data->result1 = $result1; 
					$this->load->view('templates/header');
					$this->load->view('admin/questionsecret', $data);
					$this->load->view('templates/footer');
				} else {
					$_SESSION['flash']['danger'] = 'Code invalid !';
					$this->load->view('templates/header');
					$this->load->view('admin/passwordforgot');
					$this->load->view('templates/footer');
				}
			} else {
				$_SESSION['flash']['danger'] = 'Veuillez remplis le champs pour pouvoir reinitialise votre mot de passe';
				$this->load->view('templates/header');
				$this->load->view('admin/passwordforgot');
				$this->load->view('templates/footer');
			}
		} else {
			$this->load->view('templates/header');
			$this->load->view('admin/passwordforgot');
			$this->load->view('templates/footer');
		}
	}

	/**
	* function is_reponse
	* @access public
	* @return void
	*
	*/
	function is_reponse() {
		$data = new StdClass();
		$code = $this->uri->segment(3);
		$result = $this->admin->passforgot($code);
		$result1 = $this->admin->find_personnel_by_id_for_question($result[0]->id_user);
		if ($this->input->post('valide')) {
			if (!empty($this->input->post('inputRepons'))) {
			$repons = $this->input->post('inputRepons');
			$id_question = $this->input->post('id');
			$result = $this->admin->is_reponse($repons, $id_question);
				if ($result) {
					$data->result = $result;
					$this->load->view('templates/header');
					$this->load->view('admin/passwordreset', $data);
					$this->load->view('templates/footer');
				} else {
					$data->result1 = $result1;				
					$_SESSION['flash']['danger'] = 'Reponse incorrect!';
					$this->load->view('templates/header');
					$this->load->view('admin/questionsecret', $data);
					$this->load->view('templates/footer');
				}
			}
		} else {
			$data->result1 = $result1;
			$this->load->view('templates/header');
			$this->load->view('admin/questionsecret', $data);
			$this->load->view('templates/footer');
		}
	}

	/**
	* function pass_reset
	* @access public
	* @return void
	*
	*/
	function pass_reset() {
		$data = new StdClass();
		$code = $this->uri->segment(3);
		$result = $this->admin->passforgot($code);
		$result1 = $this->admin->find_personnel_by_id_for_question($result[0]->id_user); 
		if ($this->input->post('passreset')) {
			if (!empty($this->input->post('mot_de_passe')) AND !empty($this->input->post('mot_de_passe_c'))) {
				$id_user 	= $this->input->post('id');
				$pass 		= $this->input->post('mot_de_passe');
				$passC 		= $this->input->post('mot_de_passe_c');
				if (strlen($pass) < 8){
					$data->result = $result; 
					$_SESSION['flash']['danger'] = 'Le mot de passe doit contenir au moins 8 caractere.';
					$this->load->view('templates/header');
					$this->load->view('admin/passwordreset', $data);
					$this->load->view('templates/footer');
				}elseif($pass != $passC) {
					$data->result = $result; 
					$_SESSION['flash']['danger'] = 'Le mot de passe de confirmation doit être identique avec le mot de passe';
					$this->load->view('templates/header');
					$this->load->view('admin/passwordreset', $data);
					$this->load->view('templates/footer');
				} else {
					$this->admin->pass_reset($pass,$id_user);
					$_SESSION['flash']['success'] = 'Votre mot de passe a été modifier avec succéss';
					// header('Location:login');
					redirect('user/login');
				}
			} else {
				$data->result = $result;
				$_SESSION['flash']['danger'] = 'Veuillez remplis les champs';
				$this->load->view('templates/header');
				$this->load->view('admin/passwordreset', $data);
				$this->load->view('templates/footer');
			}
		} else {
			$this->load->view('templates/header');
			$this->load->view('admin/passwordreset');
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

	/**
	* function liste_inscrir
	* @access public 
	* @return void
	*
	*/
	function liste_inscrir() {
		$data = new StdClass();
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			$inscrire = $this->admin->CompteurInscrit();
			$result = $this->user->inscrir_liste();
			$data->result = $result; 
			$data->inscrire = $inscrire; 

			$this->load->view('templates/header');
			$this->load->view('etudiant/listInscrire', $data);
			// $this->load->view('');
		}
	}

	/**
	* function liste_etudiants
	* @access public 
	* @return void
	*
	*/
	function liste_etudiants() {
		$data = new StdClass();
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			$result = $this->user->liste_etudiants();
			$data->result = $result;

			$this->load->view('templates/header');
			$this->load->view('etudiant/listetudiants', $data);
			// $this->load->view('');
		}
	}

	/**
	* function ativeUser()
	* @access public
	* @return void
	*
	*/
	function activeUser() {
		$id_etudiant = $this->uri->segment(3);
		$this->user->activeUser($id_etudiant);
		// $this->liste_inscrir();
		$this->load->view('pdfOutput');
	}
}