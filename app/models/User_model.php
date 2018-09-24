<?php 
/**
* 
*/
class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	function inscrir ($code, $inputNom , $inputPrenom, $sexe, $inputNationalite, $inputDateNaissance, $inputLieuNaissance, $inputAdresse, $inputTelephone, $inputQuestion, $inputRepons, $_status_matri, $inputpersapp, $inputTelephone_ua, $inputAdresse_uc, $inputEmail, $inputsante, $groupe_sang, $inputTelephone_ub, $inputEmail_u, $raisonetude,  $pub_ovi, $inputPersNom) {
		$token = $this->security->get_csrf_hash();
		$data = array(
			// 'foto'   => $foto,
			'matricule' 			=> $code,
			'nom'					=> $inputNom,
			'prenom'				=> $inputPrenom,
			'sexe'					=> $sexe,
			'nationalite'			=> $inputNationalite,
			'date_naiss'			=> $inputDateNaissance,
			'lieu_naiss'			=> $inputLieuNaissance,
			'adresse'				=> $inputAdresse,
			'telephone'				=> $inputTelephone,
			'id_question'			=> $inputQuestion,
			'reponse'				=> $inputRepons,
			'status_matrimonial'	=> $_status_matri,
			'persapp'				=> $inputpersapp,
			'ugctelephone_a'		=> $inputTelephone_ua,
			'ugcadresse'			=> $inputAdresse_uc,
			'email'					=> $inputEmail,
			'prob_sante'			=> $inputsante,
			'group_sanguin'			=> $groupe_sang,
			'ugctelephone'			=> $inputTelephone_ub,
			'ugcemail'				=> $inputEmail_u,
			'raisonetude'			=> $raisonetude,
			'sondage'					=> $pub_ovi,
			'entitenom'				=> $inputPersNom,
			'date_create' 			=> date('Y-m-d H:i:s'),
			'active'				=> '0',
			'token_name'			=> $token
		);
		// return $this->db->insert('etudiants', $data);

		if ($this->db->insert('etudiants', $data)) {
			//L'id courant de l'etudiant ..
			$id_etudiant = $this->db->insert_id();
			$id_option 	 = $this->input->post('option_name');

			$data = array(
				'id_etudiant' => $id_etudiant,
				'id_option'   => $id_option
			);
			return $this->db->insert('etudiants_options', $data);
		}
	}

	function last_insert(){
		$sql = 'SELECT * FROM etudiants WHERE id_etudiant = (SELECT MAX(id_etudiant) FROM etudiants); ';
		$req = $this->db->query($sql);
		if ($req->num_rows() === 1) {
			return $req->result();
		} else {
			return false;
		}
	}

	function options() {
		$sql = 'SELECT * FROM options';
		$req = $this->db->query($sql);
		if ($req->num_rows() > 0) {
			return $req->result();
		} else {
			return false;
		}
	}

	/**
	* function ativeUser()
	* @access public
	* @return void
	*
	*/
	function activeUser($id_etudiant) {
		$is_actif = $this->findEtudiantById($id_etudiant);
		foreach ($is_actif as $key ) {
			if ($key->active === '0') {
				$sql = "UPDATE etudiants SET active ='1' WHERE id_etudiant = ?";
				$this->db->query($sql, array($id_etudiant));
				return true;	
			} else {
				$sql = "UPDATE etudiants SET active ='0' WHERE id_etudiant = ? ";
				$this->db->query($sql, array($id_etudiant));
				return true;	
			}
		}
	}

	/**
	* function inscrir_liste
	* @access public
	* @return void
	*
	*/
	function inscrir_liste() {
		$sql = "SELECT (DATE_FORMAT(CURRENT_DATE, ' %Y') - DATE_FORMAT(etudiants.date_naiss,  ' %Y') ) as ages, etudiants.active, etudiants.id_etudiant, etudiants.matricule, etudiants.nom as etudiant_name, etudiants.prenom, etudiants.sexe, etudiants.adresse, etudiants.telephone, options.nom as option_name FROM etudiants_options INNER JOIN etudiants ON etudiants.id_etudiant = etudiants_options.id_etudiant
		INNER JOIN options ON options.id_option = etudiants_options.id_option" ;
		$req = $this->db->query($sql);
		if ($req->num_rows() > 0) {
			return $req->result();
		} else {
			return false;
		}
	}

	/**
	* function inscrir_liste
	* @access public
	* @return void
	*
	*/
	function liste_etudiants() {
		$sql = "SELECT (DATE_FORMAT(CURRENT_DATE, ' %Y') - DATE_FORMAT(etudiants.date_naiss,  ' %Y') ) as ages, etudiants.id_etudiant, etudiants.matricule, etudiants.nom as etudiant_name, etudiants.prenom, etudiants.sexe, etudiants.adresse, etudiants.telephone, options.nom as option_name FROM etudiants_options 
			INNER JOIN etudiants ON etudiants.id_etudiant = etudiants_options.id_etudiant
			INNER JOIN options ON options.id_option = etudiants_options.id_option
			WHERE etudiants.active = 1" ;
		$req = $this->db->query($sql);
		if ($req->num_rows() > 0) {
			return $req->result();
		} else {
			return false;
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
	function randomCode(){
		$sql = 'SELECT MAX(id_etudiant) as id_etudiant FROM etudiants';
		// $sql = 'SELECT * FROM personel';
		$req = $this->db->query($sql);
		if ($req->num_rows() === 1) {
			return $req->result_object();
		} else {
			return false;
		}		
	}

	/**
	* function findEtudiantlById
	* @access public
	* @param  int $id_etudiant
	* @return un objet 
	*
	*/
	function findEtudiantById($id_etudiant){
		$sql = 'SELECT * FROM etudiants WHERE id_etudiant = ? ';
		$req = $this->db->query($sql, array($id_etudiant));

		if ($req->num_rows() === 1 ) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return false;
		}
	}
	
}
?>