<?php
/**
 * pxHomeStatic
 *
 * @author Polinomio Devs
 */

class pxHomeStatic
{
  private $destination;  

  public function __construct()
  {
    // Options name must have a slug prefix, in this case: "asp" means A Standard Plugin
    $this->destination = get_option('px_home_static_destination');
  }

  public function getAdminOptions()
  {
    add_submenu_page( 'options-general.php', 'Home Static Generator', 'Home Static Generator', 'administrator', 'px_home_static', array($this, 'getAdminSettings'));
  }

  public function getAdminSettings()
  {
    $html = '</pre>
    <div class="wrap">
      <form action="'.admin_url('options.php').'" method="post" name="options">
        <h2>Home Static Generator</h2>' . wp_nonce_field('update-options') . '
        <table class="form-table" width="100%" cellpadding="10">
          <tbody>
            <tr>
              <td>
                <label><strong>Destination Path</strong></label>
              </td>
              <td>
                <input type="text" name="px_home_static_destination" value="'.$this->destination.'" placeholder="'.ABSPATH.'" size="60">
              </td> 
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="page_options" value="px_home_static_destination" />
                <input type="submit" name="Submit" class="button button-primary" value="Save Settings" />
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
    <pre>
    ';

    if ($this->destination) {
      $html .= '
      </pre>
        <hr>
        <h3>Generate Static File</h3>
        <p>
          This process is going to create an static file just for the homepage and save it into the destination folder. <br>Press "Generate Home" to continue.
        </p>
        ';
      if (file_exists($this->destination . DIRECTORY_SEPARATOR . 'index.html')) {
        $html .= '<div><p>The homepage static file was created on <a href="'.home_url('').'/index.html" target="_blank">index.html</a></p></div>';
      }

      if ($_GET['error'] == 'cant_write') {
        $html .= '<div class="notice notice-error is-dismissable"><p>Error creating homepage index. Directory not writable.</p></div>';
      }
      
      $html .= '
        <p>
          <form action="'.PX_HOME_STATIC_GENERATE_URL.'" method="post" name="options">
            <input type="hidden" name="generate" value="1" />
            <input type="submit" value="Generate Home" class="button button-primary" />
          </form>
        </p>
      <pre>
      ';
    }

    echo $html;
  }
}