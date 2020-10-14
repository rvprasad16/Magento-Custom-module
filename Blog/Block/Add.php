<?php

namespace Toptal\Blog\Block;

use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\Registry;
use \Toptal\Blog\Model\Post;
use \Toptal\Blog\Model\PostFactory;
use Magento\Framework\Controller\ResultFactory;

class Add extends Template
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


 public function getActionUrl() {
        return '/blog/add/done/';
    }

}
