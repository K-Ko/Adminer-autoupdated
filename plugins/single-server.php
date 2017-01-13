<?php
/**
 *
 */
class AdminerLoginSingleServer {

	/**
	 *
	 */
	protected $server;
	
	/**
	 * @param string $server
	 */
	public function __construct( $server ) {
		$this->server = $server;
	}

    /**
     *
     */
	public function login( $login, $password ) {
		// Check if server is allowed
        return ($this->server == SERVER);
	}

    /**
     *
     */
	public function loginForm() {
		?>
        <input type="hidden" name="auth[driver]" value="server">
        <input type="hidden" name="auth[server]" value="<?php echo $this->server; ?>">

        <table cellspacing="0">
        <tr>
            <th><?php echo lang('Username'); ?></th>
            <td><input id="username" name="auth[username]" value="<?php echo h($_GET["username"]);  ?>"></td>
        </tr>
        <tr>
            <th><?php echo lang('Password'); ?></th>
            <td><input type="password" name="auth[password]"></td>
        </tr>
        <tr>
            <th><?php echo lang('Database'); ?></th>
            <td><input type="text" name="auth[db]"></td>
        </tr>
        </table>

        <p>
            <input type="submit" value="<?php echo lang('Login'); ?>">
            &nbsp;
            <?php echo checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')); ?>
        </p>
        <?php
		return TRUE;
	}
	
}
