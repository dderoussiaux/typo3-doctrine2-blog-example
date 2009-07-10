<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2009 Jochen Rau <jochen.rau@typoplanet.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * The posts controller for the Blog package
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_BlogExample_Controller_PostController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_BlogExample_Domain_Model_BlogRepository
	 */
	protected $blogRepository;

	/**
	 * @var Tx_BlogExample_Domain_Model_PostRepository
	 */
	protected $postRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->blogRepository = t3lib_div::makeInstance('Tx_BlogExample_Domain_Model_BlogRepository');
		$this->postRepository = t3lib_div::makeInstance('Tx_BlogExample_Domain_Model_PostRepository');
		$this->personRepository = t3lib_div::makeInstance('Tx_BlogExample_Domain_Model_PersonRepository');
	}

	/**
	 * List action for this controller. Displays latest posts
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog to show the posts of
	 * @return string
	 */
	public function indexAction(Tx_BlogExample_Domain_Model_Blog $blog) {
		$this->view->assign('blog', $blog);
	}

	/**
	 * Action that displays one single post
	 *
	 * @param Tx_BlogExample_Domain_Model_Post $post The post to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_BlogExample_Domain_Model_Post $post) {
		$this->view->assign('post', $post);
	}
	
	/**
	 * Displays a form for creating a new post
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog the post belogs to
	 * @param Tx_BlogExample_Domain_Model_Post $newPost A fresh post object taken as a basis for the rendering
	 * @return string An HTML form for creating a new post
	 */
	public function newAction(Tx_BlogExample_Domain_Model_Blog $blog, Tx_BlogExample_Domain_Model_Post $newPost = NULL) {
		$this->view->assign('authors', $this->personRepository->findAll());
		$tag1 = new Tx_BlogExample_Domain_Model_Tag('Foo');
		$tag2 = new Tx_BlogExample_Domain_Model_Tag('Bar');
		$tag3 = new Tx_BlogExample_Domain_Model_Tag('Baz');
		$this->view->assign('tags', array($tag1, $tag2, $tag3)); // TODO Crude, but it works for demonstration
		$this->view->assign('blog', $blog);
		$this->view->assign('newPost', $newPost);
	}

	/**
	 * Creates a new post
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog the post belogns to
	 * @param Tx_BlogExample_Domain_Model_Post $newBlog A fresh Blog object which has not yet been added to the repository
	 * @param array $tags The tags
	 * @return void
	 */
	public function createAction(Tx_BlogExample_Domain_Model_Blog $blog, Tx_BlogExample_Domain_Model_Post $newPost) {
		$blog->addPost($newPost);
		$this->redirect('index', NULL, NULL, array('blog' => $blog));
	}
	
	/**
	 * Displays a form to edit an existing post
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog the post belogs to
	 * @param Tx_BlogExample_Domain_Model_Post $post The original post
	 * @return string Form for editing the existing blog
	 */
	public function editAction(Tx_BlogExample_Domain_Model_Blog $blog, Tx_BlogExample_Domain_Model_Post $post) {
		$this->view->assign('authors', $this->personRepository->findAll());
		$this->view->assign('blog', $blog);
		$this->view->assign('post', $post);
	}

	/**
	 * Updates an existing post
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog the post belongs to
	 * @param Tx_BlogExample_Domain_Model_Post $post The existing, unmodified post
	 * @param Tx_BlogExample_Domain_Model_Post $updatedPost A clone of the original post with the updated values already applied
	 * @return void
	 */
	public function updateAction(Tx_BlogExample_Domain_Model_Blog $blog, Tx_BlogExample_Domain_Model_Post $post, Tx_BlogExample_Domain_Model_Post $updatedPost) {
		$this->postRepository->replace($post, $updatedPost);
		$this->redirect('index', NULL, NULL, array('blog' => $blog));
	}

	/**
	 * Deletes an existing post
	 *
	 * @param Tx_BlogExample_Domain_Model_Blog $blog The blog the post belongs to
	 * @param Tx_BlogExample_Domain_Model_Post $post The post to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_BlogExample_Domain_Model_Blog $blog, Tx_BlogExample_Domain_Model_Post $post) {
		// TODO The following line will be replaced by $blog->removePost($post);
		$this->postRepository->remove($post);
		$this->redirect('index', NULL, NULL, array('blog' => $blog));
	}
	
}

?>