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

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
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
