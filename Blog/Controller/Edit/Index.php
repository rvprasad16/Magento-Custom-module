<?php

namespace Toptal\Blog\Controller\Edit;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\Registry;

class Index extends Action
{
const REGISTRY_KEY_POST_ID = 'toptal_blog_post_id';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     *
     * @codeCoverageIgnore
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
	Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        parent::__construct(
            $context
        );
        $this->resultPageFactory = $resultPageFactory;
	$this->_coreRegistry = $coreRegistry;
    }

    /**
     * Prints the blog from informed order id
     * @return Page
     * @throws LocalizedException
     */
    public function execute()
    {
	$this->_coreRegistry->register(self::REGISTRY_KEY_POST_ID, (int) $this->_request->getParam('id'));
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
