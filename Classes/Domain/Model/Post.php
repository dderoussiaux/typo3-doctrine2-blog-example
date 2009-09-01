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
 * A blog post
 *
 * @package Blog
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_BlogExample_Domain_Model_Post extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var int The uid of the blog the post is related to
	 */
	protected $blogUid;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var DateTime
	 */
	protected $date;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $tags;

	/**
	 * @var Tx_BlogExample_Model_Person
	 */
	protected $author;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var integer
	 */
	protected $votes = 0;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $comments;

	/**
	 * @var boolean
	 */
	protected $published = FALSE;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $relatedPosts;

	

	/**
	 * Constructs this post
	 */
	public function __construct() {
		$this->tags = new Tx_Extbase_Persistence_ObjectStorage();
		$this->comments = new Tx_Extbase_Persistence_ObjectStorage();
		$this->relatedPosts = new Tx_Extbase_Persistence_ObjectStorage();
		$this->date = new DateTime();
	}	
	
	/**
	 * Sets the uid of the blog this post is related to
	 *
	 * @param int $blogUid The blog uid
	 * @return void
	 */
	public function setBlogUid($blogUid) {
		$this->blogUid = $blogUid;
	}

	/**
	 * Returns the uid of the blog this post is related to
	 *
	 * @return int The blog uid this post is part of
	 */
	public function getBlogUid() {
		return $this->blogUid;
	}
	
	/**
	 * Setter for title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Getter for title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Setter for date
	 *
	 * @param DateTime $date
	 * @return void
	 */
	public function setDate(DateTime $date) {
		$this->date = $date;
	}

	/**
	 * Getter for date
	 *
	 *
	 * @return DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Setter for tags
	 *
	 * @param array $tags One or more Tx_BlogExample_Domain_Model_Tag objects
	 * @return void
	 */
	public function setTags(array $tags) {
		foreach ($tags as $tag) {
			$this->addTag($tag);			
		}
	}

	/**
	 * Adds a tag to this post
	 *
	 * @param Tx_BlogExample_Domain_Model_Tag $tag
	 * @return void
	 */
	public function addTag(Tx_BlogExample_Domain_Model_Tag $tag) {
		$this->tags->attach($tag);
	}

	/**
	 * Adds a tag to this post
	 *
	 * @param Tx_BlogExample_Domain_Model_Tag $tag
	 * @return void
	 */
	public function removeTag(Tx_BlogExample_Domain_Model_Tag $tagToDelete) {
		foreach ($this->tags as $key => $tag) {
			if ($tag === $tagToDelete) {
				unset($this->tags[$key]);
				reset($this->tags);
				return;
			}
		}
	}
	
	/**
	 * Remove all tags from this post
	 *
	 * @return void
	 */
	public function removeAllTags() {
		$this->tags = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for tags
	 *
	 * @return array holding Tx_BlogExample_Domain_Model_Tag objects
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * Sets the author for this post
	 *
	 * @param Tx_BlogExample_Domain_Model_Person $author
	 * @return void
	 */
	public function setAuthor(Tx_BlogExample_Domain_Model_Person $author) {
		$this->author = $author;
	}

	/**
	 * Getter for author
	 *
	 * @return Tx_BlogExample_Domain_Model_Person
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the content for this post
	 *
	 * @param string $content
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * Getter for content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Sets the votes for this post
	 *
	 * @param integer $votes
	 * @return void
	 */
	public function setVotes($votes) {
		$this->votes = $votes;
	}

	/**
	 * Getter for votes
	 *
	 * @return integer
	 */
	public function getVotes() {
		return $this->votes;
	}

	/**
	 * Setter for the comments to this post
	 *
	 * @param array $comments an array of Tx_BlogExample_Domain_Model_Comment instances
	 * @return void
	 */
	public function setComments(array $comments) {
		foreach ($comments as $comment) {
			$this->addComment($comment);
		}
	}

	/**
	 * Adds a comment to this post
	 *
	 * @param Tx_BlogExample_Domain_Model_Comment $comment
	 * @return void
	 */
	public function addComment(Tx_BlogExample_Domain_Model_Comment $comment) {
		$this->comments->attach($comment);
	}
	
	/**
	 * Remove all comments from this post
	 *
	 * @return void
	 */
	public function removeAllComments() {
		$this->comments = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the comments to this post
	 *
	 * @return An Tx_Extbase_Persistence_ObjectStorage holding instances of Tx_BlogExample_Domain_Model_Comment
	 */
	public function getComments() {
		// TODO This should be invoked transparently
		if ($this->comments instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->comments->_loadRealInstance();
		}
		return clone $this->comments;
	}
	
	/**
	 * Setter for the related posts
	 *
	 * @param array $relatedPosts an array of Tx_BlogExample_Domain_Model_Post instances
	 * @return void
	 */
	public function setRelatedPosts(array $relatedPosts) {
		foreach ($relatedPosts as $relatedPost) {
			$this->addRelatedPost($relatedPosts);
		}
	}
	
	/**
	 * Adds a related post
	 *
	 * @param Tx_BlogExample_Domain_Model_Post $comment
	 * @return void
	 */
	public function addRelatedPost(Tx_BlogExample_Domain_Model_Post $post) {
		if ($this->relatedPosts instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->relatedPosts->_loadRealInstance();
		}
		$this->relatedPosts->attach($post);
	}
	
	/**
	 * Remove all related posts
	 *
	 * @return void
	 */
	public function removeAllRelatedPosts() {
		$this->relatedPosts = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the related posts
	 *
	 * @return An Tx_Extbase_Persistence_ObjectStorage holding instances of Tx_BlogExample_Domain_Model_Post
	 */
	public function getRelatedPosts() {
		// TODO This should be invoked transparently
		if ($this->relatedPosts instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->relatedPosts->_loadRealInstance();
		}
		return clone $this->relatedPosts;
	}
	
	/**
	 * Sets the published/unpublished state for this post
	 *
	 * @param boolean $published
	 * @return void
	 */
	public function setPublished($published) {
		$this->published = $published;
	}

	/**
	 * Getter for published/unpublished state of this post
	 *
	 * @return boolean
	 */
	public function getPublished() {
		return $this->published;
	}
	
	/**
	 * Returns this post as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->title . chr(10) .
			' written on ' . $this->date->format('Y-m-d') . chr(10) .
			' by ' . $this->author->getFullName() . chr(10) .
			wordwrap($this->content, 70, chr(10)) . chr(10) .
			implode(', ', $this->tags->toArray());
	}
}
?>