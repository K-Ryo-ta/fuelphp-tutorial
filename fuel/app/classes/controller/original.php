<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

use Auth\Auth;
use Fuel\Core\DB;
use Fuel\Core\Input;
use Fuel\Core\Session;

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Original extends Controller
{
  /**
   * The basic welcome message
   *
   * @access  public
   * @return  Response
   */
  public function action_index()
  {
    // return Response::forge(View::forge('welcome/index'));
    echo "Welcome to FuelPHP!";
  }

  public function action_nikoniko()
  {
    // return Response::forge(View::forge('welcome/index'));
    echo "ニコニコにーーーーーー";
  }

  public function action_word($word)
  {
    // return Response::forge(View::forge('welcome/index'));
    echo $word;
  }

  public function action_viewtest()
  {
    $data = array();
    $data['date'] = date('Y年n月j日');
    return View::forge('viewtest', $data);
  }

  public function action_layout()
  {
    $data = array();
    $data['title'] = 'Layout Example';
    $data['content'] = 'This is an example of using a layout with views in FuelPHP.';

    $view = array();
    $view['header'] = View::forge('header', $data);
    $view['content'] = View::forge('content', $data);
    $view['footer'] = View::forge('footer');

    return View::forge('layout', $view);
  }

  public function action_arrayView()
  {
    $data = array();

    $data['fruits'] = ['Apple', 'Banana', 'Cherry', 'Date', 'Elderberry'];

    $data['members'] = [
      array('name' => 'John', 'age' => 30),
      array('name' => 'Mari', 'age' => 20),
      array('name' => 'Tatsuya', 'age' => 21),
      array('name' => 'Kobayashi', 'age' => 26),
      array('name' => 'Mikel', 'age' => 35),
    ];

    return View::forge('array', $data);
  }

  public function action_twig()
  {
    $data = array();

    $data['name'] = 'twigwig';

    $data['members'] = [
      array('name' => 'John', 'age' => 30),
      array('name' => 'Mari', 'age' => 20),
      array('name' => 'Tatsuya', 'age' => 21),
      array('name' => 'Kobayashi', 'age' => 26),
      array('name' => 'Mikel', 'age' => 35),
    ];

    return View::forge('twigpractice.twig', $data);
  }

  public function action_insert()
  {
    DB::insert('friends')->set(array(
      'name1' => '山田',
      'name2' => '太郎',
      'tel' => '09012345678',
      'email' => 'taro@example.com',
    ))->execute();
  }

  public function action_select()
  {
    // $result = DB::select('*')->from('friends')->where('id', '=', '2')->execute()->as_array();
    // $result = DB::select('*')->from('friends')->order_by('age', 'desc')->execute()->as_array();
    $result = DB::select('*')->from('friends')->where('age', '>=', '30')->execute()->as_array();
    echo '<pre>';
    print_r($result);
  }

  public function action_update()
  {
    // DB::update('friends')->value('name1', '佐藤')->where('id', '=', '1')->execute();
    DB::update('friends')->set(array(
      'name1' => '近藤',
      'name2' => '花子',
      'tel'  => '08098765432',
    ))->where('id', '=', '3')->execute();
  }

  public function action_delete()
  {
    DB::delete('friends')->where('id', '=', '2')->execute();
  }

  public function action_form()
  {
    if (Input::method() == 'POST') {
      $val = Validation::forge();
      $val->add_field('name1', '姓', 'required');
      $val->add_field('name2', '名', 'required');
      $val->add_field('tel', '電話番号', 'required');
      $val->add_field('email', 'メールアドレス', 'required|valid_email');
      $val->add_field('age', '年齢', 'numeric_between[18,35]');
      if ($val->run()) {
        echo "Validation passed!";
        exit;
      } else {
        echo "Validation failed! . '<br>'";
        foreach ($val->error() as $field => $error) {
          echo $error->get_message() . '<br>';
        }
        exit;
      }
    }


    DB::insert('friends')->set(array(
      'name1' => Input::post('name1'),
      'name2' => Input::post('name2'),
      'tel' => Input::post('tel'),
      'email' => Input::post('email'),
    ))->execute();
    return View::forge('form');
  }

  public function action_upload()
  {
    if (Input::method() == 'POST') {
      // このアップロードのカスタム設定
      $config = array(
        'path' => DOCROOT . 'files',
        'randomize' => true,
        'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
      );

      // $_FILES 内のアップロードされたファイルを処理する
      Upload::process($config);

      // 有効なファイルがある場合
      if (Upload::is_valid()) {
        // 設定にしたがって保存する
        Upload::save();

        // モデルを呼び出してデータベースを更新する
        // Model_Uploads::add(Upload::get_files());
      }

      // エラーを処理する
      foreach (Upload::get_errors() as $file) {
        // $file はファイル情報の配列
        // $file['errors'] は発生したエラーの内容を含む配列で、
        // 配列の要素は 'error' と 'message' を含む配列
        foreach ($file['errors'] as $error) {
          // エラーの内容を表示
          echo 'Error: ' . $error['error'] . ' - ' . $error['message'] . '<br>';
        }
      }
    }
    return View::forge('upload');
  }

  public function action_mail()
  {
    return View::forge('mail');
  }

  public function action_auth()
  {
    // Auth::create_user('yamada', 'password', 'yamada@test.com', 1);
    // var_dump(Auth::login('suzuki', 'password'));
    if (Auth::login('yamada', 'newpassword')) {
      echo "ログイン成功";
    } else {
      echo "ログイン失敗";
    }
  }

  public function action_logout()
  {
    Auth::logout();
    echo "ログアウトしました";
  }

  public function action_authcheck()
  {
    if (Auth::check()) {
      echo "ログインしています";
    } else {
      echo "ログインしていません";
    }
  }

  public function action_changepassword()
  {
    Auth::change_password('password', 'newpassword', 'yamada');
  }

  public function action_updatemailaddress()
  {
    Auth::update_user(
      array('email' => 'new@test.com'),
    );
  }

  public function action_deleteuser()
  {
    Auth::delete_user(
      'yamada'
    );
  }

  public function action_session()
  {
    // Session::set('birthday', '7月7日');
    // echo Session::get('birthday');
    // Session::delete('birthday');
    // Session::set_flash('birthday', '7月7日');
    // echo Session::get_flash('birthday');
  }

  /**
   * A typical "Hello, Bob!" type example.  This uses a Presenter to
   * show how to use them.
   *
   * @access  public
   * @return  Response
   */
  public function action_hello()
  {
    return Response::forge(Presenter::forge('welcome/hello'));
  }

  /**
   * The 404 action for the application.
   *
   * @access  public
   * @return  Response
   */
  public function action_404()
  {
    return Response::forge(Presenter::forge('welcome/404'), 404);
  }
}
