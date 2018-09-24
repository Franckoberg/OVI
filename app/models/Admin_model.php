<?php 

class Admin_model extends CI_Model {
	
	/**
	* function __contruct()
	* @access public
	* @return void
	*
	*/
	function __construct() {
		$this->load->database();
	}

	/**
	* function ativeUser()
	* @access public
	* @return void
	*
	*/
	function activeUser($id_user) {
		$is_actif = $this->findPersonnelById($id_user);
		foreach ($is_actif as $key ) {
			if ($key->active === '0') {
				$sql = "UPDATE users SET active ='1' WHERE id_user = ?";
				$this->db->query($sql, array($id_user));
				return true;	
			} else {
				$sql = "UPDATE users SET active ='0' WHERE id_user = ? ";
				$this->db->query($sql, array($id_user));
				return true;	
			}
		}
	}

	/**
	* function check_if_email_exists
	* @access public
	* @param string $email
	* @return bool
	* 
	*/
    function check_if_email_exists($email){
    	$this->db->WHERE('email', $email);
		$req = $this->db->get('users');
		if ($req->num_rows() > 0) {
			return flase;
		}else {
			return true;
		}    	
    }

	/**
	* function login
	* @access public
	* @param string $email
	* @param string $password
	* @return object [Un objet]
	*
	*/
	function login($email, $password) {
		$sql = 'SELECT id_user, nom, fonction, foto, email FROM users WHERE email = ? AND mot_de_passe = ?';
		$req = $this->db->query($sql, array($email, $password));

		$sql1 = 'SELECT id_user, nom, fonction, foto, email FROM users WHERE nom = ? AND mot_de_passe = ?';
		$req1 = $this->db->query($sql1, array($email, $password));

		if ($req->num_rows() === 1) {
			return $req->result();
		} elseif ($req1->num_rows() === 1) {
			return $req1->result();
		} else {
			return false;
		}
	}

	/**
	* function register
	* @access public
	* @param string 
	* @param string 
	* @param string 
	* @param string 
	* @param string 
	* @return void
	*
	*/
	function updregister($code, $nationalite,$password, $date_naiss, $inputsante, $gsang, $status, $profession, $cin, $telephone, $adresse, $email, $ugpersonne, $ugtelephone_a, $ugtelephone_b, $ugadresse, $ugemail,$inputQuestion, $inputRepons) {
		// $question = $this->input->post('inputQuestion');
		$req = 'SELECT * FROM question WHERE question = ?';
		$query = $this->db->query($req, array($inputQuestion));

		if ($query->num_rows() === 1 ) {
			foreach ($query->result() as $key ) {
				$id_quest = $key->id_question;
				$sql = "UPDATE users SET nationalite =?, mot_de_passe =?, date_naiss =?, maladie =?, groupe_sanguin =?, status_matrimonial =?, profession =?, cin =?, telephone =?, adresse =?, email =?, ugpersonne_nom =?, ugtelephone_a =?, ugtelephone_b =?, ugadresse =?, ugemail =?, id_question =?, reponse =? WHERE matricule = ? ";

				return $req = $this->db->query($sql, array($nationalite,$password, $date_naiss,  $inputsante, $gsang, $status, $profession, $cin, $telephone, $adresse, $email, $ugpersonne, $ugtelephone_a, $ugtelephone_b, $ugadresse, $ugemail, $id_quest, $inputRepons, $code ) );
			}
		}
	}

	/**
	* function register
	* @access public
	* @param string 
	* @param string 
	* @param string 
	* @param string 
	* @param string 
	* @return void
	*
	*/
	function admregister($code,$nom, $prenom, $password, $fonction, $sexe) {
		
		$data = array(
			// 'foto'   => $foto,
			'matricule' 	=> $code,
			'nom'			=> $nom,
			'prenom'		=> $prenom,
			'sexe'			=> $sexe,
			'mot_de_passe'	=> $password,
			'fonction'		=> $fonction,
			'date_create' 	=> date('Y-m-d H:i:s'),
			'active'		=> '1'
		);

		if ($this->db->insert('users', $data)) {
			$id_u = $this->db->insert_id(); 

			$sql = "SELECT fonction, id_role FROM users INNER JOIN roles ON roles.nom = users.fonction WHERE id_user = ?";
			$sql1 = $this->db->query($sql, array($id_u))->result();
			if ($sql1) {
				foreach ($sql1 as $key ) {
					$data = array(
						'id_user'	=> $id_u,
						'id_role'	=> $key->id_role						
					);
				}
				return $this->db->insert('user_roles', $data);
			}
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
		$sql = 'SELECT MAX(id_user) as id_user FROM users';
		// $sql = 'SELECT * FROM personel';
		$req = $this->db->query($sql);
		if ($req->num_rows() === 1) {
			return $req->result_object();
		} else {
			return false;
		}		
	}

	/**
	* function create_role
	* @access public
	* @param string $nom
	* @param string $description
	* @return void
	*
	*/
	function create_role($nom, $desc) {
		$data = array(
			'nom'			=> $nom,
			'description'	=> $desc
		);
		return $this->db->insert('roles', $data);
	}

	/**
	* function updateRole
	* @access public
	* @param string $nom
	* @param string $description
	* @param int 	$idRoles
	* @return void
	*
	*/
	function updateRole($nom, $description, $id_role) {
		// $sql = "UPDATE roles SET nom = ?, description = ? WHERE id_role = ?";
		// return $this->db->query($sql, array($nom, $description, $idrole));

		$data = array(
			'nom'	=> $nom,
			'description'	=> $description
		);
		$this->db->where('id_role', $id_role);
		$this->db->update('roles', $data);
	}

	/**
	* function delete_role
	* @access public
	* @param int $idRole
	* @return void
	*
	*/
	function delete_role($id_role) {
		$sql = "DELETE FROM roles WHERE id_role = ? ";
		return $this->db->query($sql, array($id_role));		
	}

	/**
	* function listRoles
	* @access public
	* @return un tableau d'objet
	*
	*/
	function listRoles() {
		$sql = "SELECT * FROM roles WHERE nom != 'DBA' ";
		$req = $this->db->query($sql);

		if($req->num_rows() > 0 ) {
			return $req->result();
		} else {
			return $req->result(); ;
		}
	}

	/**
	* function findPersonnelById
	* @access public
	* @return un tableau d'objet 
	*
	*/
	function findPersonnel() {
		$sql = 'SELECT * FROM users WHERE fonction != "DBA" ';
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return false;
		}
	}

	/**
	* function findPersonnelById
	* @access public
	* @param  int $id_user
	* @return un objet 
	*
	*/
	function findPersonnelById($id_user){
		$sql = 'SELECT * FROM users WHERE id_user = ? ';
		$req = $this->db->query($sql, array($id_user));

		if ($req->num_rows() === 1 ) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return false;
		}
	}

	/**
	* function findPersonnelById
	* @access public
	* @param  int $id_user
	* @return un objet 
	*
	*/
	function find_personnel_by_id_for_question($id_user){
		$sql = 'SELECT matricule, question, reponse, users.id_question FROM users INNER JOIN question ON users.id_question = question.id_question AND id_user = ?';
		$req = $this->db->query($sql, array($id_user));

		if ($req->num_rows() === 1 ) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return false;
		}
	}

	/**
	* function updateProfil
	* @access public
	* @param sting $nom
	* @param sting $prenom
	* @param sting $sexe
	* @param sting $fonction
	* @param sting $cin
	* @param sting $adresse
	* @param sting $email
	* @param sting $telephone
	* @param sting $status
	* @param sting $profession
	* @param sting $idprofesseur
	* @return void
	* 
	*/
	function updateProfil($nom,$prenom,$sexe,$fonction,$cin,$adresse,$email,$telephone,$status,$profession, $idprofesseur){
		$sql = "UPDATE users SET nom = ?, prenom = ?, sexe = ?, cin = ?, adresse = ?, email = ?, telephone = ?, status_matrimonial = ?, profession = ?, date_a_jour = ? WHERE id_user = ?";
		return $this->db->query($sql, array($nom,$prenom,$sexe,$fonction,$cin,$adresse,$email,$telephone,$status,$profession, date('Y-m-d H:i:s'), $id_user));
	}

	/**
	* function deletePersonnel
	* @access public
	* @param int $id_user
	* @return void
	*
	*/
	function deletePersonnel($id_user) {
		$sql = "DELETE FROM users WHERE id_user = ? ";
		return $this->db->query($sql, array($id_user));		
	}

	function user_question() {
		$sql = 'SELECT * FROM question ';
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result();
		} else {
			return false;
		}
	}

	/**
	* function passforgot
	*
	*
	*/
	function passforgot($user_code) {
		$sql = 'SELECT matricule, id_user FROM users WHERE matricule = ?';
		$req = $this->db->query($sql, array($user_code));
		if ($req->num_rows() === 1) {
			return $req->result();
		} else {
			return false;
		}
	}

	/**
	* function pass_reset
	*
	*
	*/
	function pass_reset($mot_de_passe, $id_user) {
		$sql = 'UPDATE users SET mot_de_passe = ? WHERE id_user = ?';
		return $req = $this->db->query($sql, array($mot_de_passe, $id_user));
	}

	/**
	* function is_reponse
	*
	*
	*/
	function is_reponse ($repons, $id_question) {
		$sql = 'SELECT * FROM users WHERE reponse = ? AND id_question = ?';
		$req = $this->db->query($sql, array($repons, $id_question));
		if ($req->num_rows() === 1 ) {
			return $req->result_object();
		} else {
			return false;
		}
	}

	/**
	* function CompteurInscrit
	* @access public
	* return void
	*/
	function CompteurInscrit() {
		$sql = 'SELECT COUNT(*) as nbre_de_inscrires FROM etudiants_options INNER JOIN etudiants ON etudiants.id_etudiant = etudiants_options.id_etudiant INNER JOIN options ON options.id_option = etudiants_options.id_option';
		$req = $this->db->query($sql);
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return '0';
		}
	}
}
?>