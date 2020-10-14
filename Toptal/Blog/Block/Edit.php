<?php

namespace Toptal\Blog\Block;

use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\Registry;
use \Toptal\Blog\Model\Post;
use \Toptal\Blog\Model\PostFactory;
use Magento\Framework\Controller\ResultFactory;
use \Toptal\Blog\Controller\Post\View as ViewAction;

class Edit extends Template
{
    /**
     * Core registry
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Post
     * @var null|Post
     */
    protected $_post = null;

    /**
     * PostFactory
     * @var null|PostFactory
     */
    protected $_postFactory = null;

    protected $resultRedirect;

    /**
     * Constructor
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PostFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PostFactory $postFactory,
        array $data = [],
\Magento\Framework\Controller\ResultFactory $result
    ) {
        $this->_postFactory = $postFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
	$this->resultRedirect = $result;
    }

	public function getPost()
    {
        if ($this->_post === null) {
            /** @var Post $post */
            $post = $this->_postFactory->create();
            $post->load($this->_getPostId());

            if (!$post->getId()) {
                throw new LocalizedException(__('Post not found'));
            }

            $this->_post = $post;
        }
        return $this->_post;
    }

    /**
     * Retrieves the post id from the registry
     * @return int
     */
    protected function _getPostId()
    {
        return (int) $this->_coreRegistry->registry(
            ViewAction::REGISTRY_KEY_POST_ID
        );
    }


 public function getActionUrl() {
        return '/blog/edit/done/id/'. $this->getPost()->getId();
    }

 public function getDeleteUrl() {
        return '/blog/edit/delete/';
    }


}
