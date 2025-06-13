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

use Fuel\Core\DB;

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
