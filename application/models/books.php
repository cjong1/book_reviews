<?php

class books extends CI_Model {

	function create_user($data)
	{
		$password = md5($data['password']);
		$query = $this->db->query('INSERT INTO users (name, alias, email, password, created_at) VALUES (?,?,?,?, NOW())', array($data['name'], $data['alias'], $data['email'], $password));
		return $query;
	}

	function get_user_by_email($email)
	{
		$query = $this->db->query('SELECT * FROM users WHERE email = ?', array($email));
		return $query->row_array();
	}

	function get_reviews()
	{
		$query = $this->db->query("SELECT users.id, users.alias, books.id as book_id, books.name, books.author, reviews.created_at, reviews.review, reviews.rating FROM books
			LEFT JOIN reviews ON books.id = reviews.books_id
			LEFT JOIN users ON users.id = reviews.users_id
			ORDER BY created_at DESC
			LIMIT 3");
		return $query->result();
	}

	function get_authors()
	{
		$query = $this->db->query("SELECT books.author from books");
		return $query->result();
	}

	function get_user_by_id($id)
	{
		$query = $this->db->query('SELECT * FROM users WHERE id = ?', array($id));
		return $query->row_array();
	}

	function review_count($id)
	{
		$query = $this->db->query('SELECT COUNT(*) as count FROM reviews WHERE users_id = ?', array($id));
		return $query->row();
	}

	function get_books_with_reviews_by_id($id)
	{
		$query = $this->db->query('SELECT books.name, books.id FROM books
				LEFT JOIN reviews ON books.id = reviews.books_id
				LEFT JOIN users ON users.id = reviews.users_id
				WHERE users_id = ?', array($id));
		return $query->result();
	}

	function get_reviews_by_book($id)
	{
		$query = $this->db->query("SELECT books.name, books.author, books.id as book_id, reviews.review, reviews.rating, users.id, users.alias, reviews.created_at FROM books
			LEFT JOIN reviews ON books.id = reviews.books_id
			LEFT JOIN users ON users.id = reviews.users_id
			WHERE books.id = ?", array($id));
		return $query->result_array();
	}

	function add_review($id)
	{
		$query = $this->db->query("INSERT INTO reviews (review, rating, users_id, books_id, created_at) VALUES (?,?,?,?, NOW())", array($id['review'], $id['rating'], $id['user'], $id['book']));
		return $query;
	}

	function add_book_new($data)
	{
		$query = $this->db->query("INSERT INTO books (name, author) VALUES(?,?)", array($data['title'], $data['new_author']));
		$id = $this->db->insert_id();
		$this->create_review($data, $id);
	}

	function create_review($data,$id)
	{
		$query = $this->db->query("INSERT INTO reviews (review, rating, users_id, books_id, created_at) VALUES (?,?,?, $id, NOW())", array($data['review'], $data['rating'], $data['user']));
		return $query;
	}

	function add_book_old()
	{
		$query = $this->db->query("INSERT INTO books (name, author) VALUES(?,?)", array($data['title'], $data['author_list']));
		return $query;
	}

	function get_latest_book()
	{
		$query = $this->db->query("SELECT books.id from books ORDER BY id DESC LIMIT 1");
		return $query->result();
	}

}