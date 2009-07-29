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
 * A repository for Blogs
 */
class Tx_BlogExample_Domain_Repository_BlogRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Remove the blog's posts before removing the blog itself.
	 *
	 * @param int $blog
	 * @return void
	 */
	public function remove($blog) {
		if ($blog instanceof Tx_BlogExample_Domain_Model_Blog) {
			foreach ($blog->getPosts() as $post) {
				$post->removeAllTags();
				$post->removeAllComments();
			}
			parent::remove($blog);
		}
	}

	public function findSpecial() {
		$query = $this->createQuery();
//		$query->matching(
//			$query->logicalAnd(
// 				$query->logicalNot($query->like('description', '%foo%')),
//				$query->logicalOr(
//					$query->like('name', '%og%'),
//					$query->like('name', '%asd%')
//				)
// 			)
// 		)
//		$query->matching(
//			$query->logicalOr(
//				$query->logicalNot($query->equals('column1', NULL)),
//				$query->logicalOr(
//					$query->like('column2', '%test%'),$query->like('column3', '%test%')
//					)
//				)
//			);
//		$query->matching(
//			$query->logicalOr(
//				$query->logicalNot($query->equals('name', 'Blog #1')),
//				$query->logicalOr(
//					$query->like('description', '%test%'),$query->like('description', '%foo%')
//					)
//				)
//			);
//		$query->matching(
//			$query->greaterThan('name', 'C')
//			);
//		$query->statement('SELECT * FROM tx_blogexample_domain_model_blog WHERE deleted=0');
		$query->statement("SELECT * FROM tx_blogexample_domain_model_blog WHERE SUBSTRING(title,1,1) LIKE BINARY 'B' AND description LIKE '%blog%' ORDER BY title ASC");
		
//		$query->setOrderings(array('name' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING));
//		$query->setLimit(1);
//		$query->setOffset(1);
		

		$blogs = $query->execute();

		return $blogs;
	}
}
?>