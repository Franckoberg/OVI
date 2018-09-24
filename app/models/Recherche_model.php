<?php 

class Recherche_model extends CI_Model {
	
	/**
	* function __construct
	* @access public
	* @return void
	* 
	*/
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	* function search
	* @access public
	* @param string $search
	* @return void
	* 
	*/
	function search($search){
		$r = "SET lc_time_names = 'fr_FR'";
		$sql = "
		SELECT DATE_FORMAT(etudiants.date_naiss, '%d %M %Y') as date_naiss, etudiants.matricule, etudiants.nom, etudiants.prenom, etudiants.sexe, etudiants.adresse, etudiants.status_matrimonial, etudiants.email, etudiants.telephone, etudiants.persapp, etudiants.prob_sante, etudiants.ugctelephone_a, etudiants.ugcadresse, options.nom as options_name FROM etudiants_options INNER JOIN etudiants ON etudiants.id_etudiant = etudiants_options.id_etudiant
		INNER JOIN options ON options.id_option = etudiants_options.id_option
		WHERE Upper(etudiants.matricule) = ? || Upper(etudiants.matricule) like '".$search."%' 
		UNION
		(
		SELECT DATE_FORMAT(etudiants.date_naiss, '%d %M %Y') as date_naiss, etudiants.matricule, etudiants.nom, etudiants.prenom, etudiants.sexe, etudiants.adresse, etudiants.status_matrimonial, etudiants.email, etudiants.telephone, etudiants.prob_sante, etudiants.persapp, etudiants.ugctelephone_a, etudiants.ugcadresse, options.nom as options_name FROM etudiants_options INNER JOIN etudiants ON etudiants.id_etudiant = etudiants_options.id_etudiant
		INNER JOIN options ON options.id_option = etudiants_options.id_option
		WHERE Upper(etudiants.nom) = ? || Upper(etudiants.nom) like '".$search."%'
		)
		UNION SELECT DATE_FORMAT(etudiants.date_naiss, '%d %M %Y') as date_naiss, etudiants.matricule, etudiants.nom, etudiants.prenom, etudiants.sexe, etudiants.adresse, etudiants.status_matrimonial, etudiants.email, etudiants.telephone, etudiants.prob_sante, etudiants.persapp, etudiants.ugctelephone_a, etudiants.ugcadresse, options.nom as options_name FROM etudiants_options INNER JOIN etudiants ON etudiants.id_etudiant = etudiants_options.id_etudiant
		INNER JOIN options ON options.id_option = etudiants_options.id_option
		WHERE Upper(etudiants.prenom) = ? || Upper(etudiants.prenom) like '".$search."%'		
		";

		$req = $this->db->query($r);
		$query = $this->db->query($sql, array($search, $search, $search)); // var_dump($query);

		if ($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			// echo "Data not found ..";
			// return false;
			return $query->result();
		}
	}

}