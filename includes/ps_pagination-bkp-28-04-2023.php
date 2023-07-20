<?php
/**
 * PHPSense Pagination Class
 *
 * PHP tutorials and scripts
 *
 * @package		PHPSense
 * @author		Jatinder Singh Thind
 * @copyright	Copyright (c) 2006, Jatinder Singh Thind
 * @link		http://www.phpsense.com
 */

// ------------------------------------------------------------------------

   
class PS_Pagination {
	public $php_self;
	public $rows_per_page = 8; //Number of records to display per page
	public $total_rows = 0; //Total number of rows returned by the query
	public $links_per_page = 8; //Number of links to display per page
	public $append = ""; //Paremeters to append to pagination links
	public $sql = "";
	public $debug = false;
	public $conn = true;
	public $page = 1;
	public $max_pages = 0;
	public $offset = 0;
	
	/**
	 * Constructor
	 *
	 * @param resource $connection Mysql connection link
	 * @param string $sql SQL query to paginate. Example : SELECT * FROM users
	 * @param integer $rows_per_page Number of records to display per page. Defaults to 2
	 * @param integer $links_per_page Number of links to display per page. Defaults to 5
	 * @param string $append Parameters to be appended to pagination links 
	 */
	
	function PS_Pagination($conn, $sql, $append = "") {

		
			$rows_per_page =10;
			$links_per_page =8;

		$this->conn = $conn;
		$this->sql = $sql;
		
		$this->rows_per_page = (int)$rows_per_page;
		
		if (intval($links_per_page ) > 0) {
			$this->links_per_page = (int)$links_per_page;
		} else {
			$this->links_per_page = 2;
		}
		 $this->append = $append;
		 $this->php_self = htmlspecialchars($_SERVER['PHP_SELF'] );
		if (isset($_GET['page'] )) {
		 $this->page = intval($_GET['page'] );
		}
	}
	
	/**
	 * Executes the SQL query and initializes internal variables
	 *
	 * @access public
	 * @return resource
	 */
	function paginate($conn, $sql, $append = "") {
	
		//Check for valid mysql connection
		// if (! $this->conn || ! is_resource($this->conn )) {

		// 	if ($this->debug)
		// 		echo "MySQL connection missing<br />";
		// 	return false;
		// }
		
		
		//Find total number of rows
	
		 $all_rs = mysqli_query($conn,$sql);
		 
		if (! $all_rs) {

			if ($this->debug)
				echo "SQL query failed. Check your query.<br /><br />Error Returned: " . mysqli_error();
			return false;
		}

		$this->total_rows = mysqli_num_rows($all_rs );
		
		//mysqli_close($conn,$all_rs);
		
		//Return FALSE if no rows found
		if ($this->total_rows == 0) {
			if ($this->debug)
				echo "Query returned zero rows.";
			return FALSE;
		}
		
		//Max number of pages
		 $this->max_pages = ceil($this->total_rows / $this->rows_per_page );
		if ($this->links_per_page > $this->max_pages) {
			$this->links_per_page = $this->max_pages;
		}

		//Check the page value just in case someone is trying to input an aribitrary value
		if ($this->page > $this->max_pages || $this->page <= 0) {
			 $this->page = 1;
		}
		
		//Calculate Offset
		$this->offset = $this->rows_per_page * ($this->page - 1);
		
		//Fetch the required result set
		//return $this->sql . " LIMIT {$this->offset}, {$this->rows_per_page}";
		$rs = mysqli_query($conn,$sql . " LIMIT {$this->offset}, {$this->rows_per_page}" );
		if (! $rs) {
			if ($this->debug)
				echo "Pagination query failed. Check your query.<br /><br />Error Returned: " . mysqli_error();
			return false;
		}
		return $rs;
	}
	
	/**
	 * Display the link to the first page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'First'
	 * @return string
	 */
	function renderFirst($tag = 'First') {
		if ($this->total_rows == 0 )
			return FALSE;
		
		if ($this->page == 1) {
			return "$tag ";
		} else {
			return '<a href="' . $this->php_self . '?page=1&' . $this->append . '">' . $tag . '</a> ';
		}
	}
	
	/**
	 * Display the link to the last page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'Last'
	 * @return string
	 */
	function renderLast($tag = 'Last') {
		if ($this->total_rows == 0 )
			return FALSE;
		
		if ($this->page == $this->max_pages) {
			return $tag;
		} else {
			return ' <a href="' . $this->php_self . '?page=' . $this->max_pages . '&' . $this->append . '">' . $tag . '</a>';
		}
	}
	
	/**
	 * Display the next link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '>>'
	 * @return string
	 */
	function renderNext($tag = '&gt;&gt;') {
		if ($this->total_rows == 0 )
			return FALSE;
		
		if ($this->page < $this->max_pages) {
			return '<a href="' . $this->php_self . '?page=' . ($this->page + 1) . '&' . $this->append . '">' . $tag . '</a>';
		} else {
			return $tag;
		}
	}
	
	/**
	 * Display the previous link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '<<'
	 * @return string
	 */
	function renderPrev($tag = '&lt;&lt;') {
		if ($this->total_rows == 0 )
			return FALSE;
		
		if ($this->page > 1) {
			return ' <a href="' . $this->php_self . '?page=' . ($this->page - 1) . '&' . $this->append . '">' . $tag . '</a>';
		} else {
			return " $tag";
		}
	}
	
	/**
	 * Display the page links
	 *
	 * @access public
	 * @return string
	 */
	function renderNav($prefix = '<span class="page_link">', $suffix = '</span>') {
		if ($this->total_rows == 0 )
			return FALSE;
		
		$batch = ceil($this->page / $this->links_per_page );
		$end = $batch * $this->links_per_page;
		if ($end == $this->page) {
			//$end = $end + $this->links_per_page - 1;
		//$end = $end + ceil($this->links_per_page/2);
		}
		if ($end > $this->max_pages) {
			$end = $this->max_pages;
		}
		$start = $end - $this->links_per_page + 1;
		$links = '';
		
		for($i = $start; $i <= $end; $i++) {
			if ($i == $this->page) {
				$links .= $prefix . " $i " . $suffix;
			} else {
				$links .= ' ' . $prefix . '<a href="' . $this->php_self . '?page=' . $i . '&' . $this->append . '">' . $i . '</a>' . $suffix . ' ';
			}
		}
		
		return $links;
	}
	
	/**
	 * Display full pagination navigation
	 *
	 * @access public
	 * @return string
	 */

			function renderFullNav() {
			
					if ($this->total_rows > $this->rows_per_page )
					{
						return $this->renderFirst() . '&nbsp;' . $this->renderPrev() . '&nbsp;' . $this->renderNav() . '&nbsp;' . $this->renderNext() . '&nbsp;' . $this->renderLast();
					}
					else
					 {
					 
					 }
			}
	
	
	/**
	 * Set debug mode
	 *
	 * @access public
	 * @param bool $debug Set to TRUE to enable debug messages
	 * @return void
	 */
	function setDebug($debug) {
		$this->debug = $debug;
	}
}
?>
