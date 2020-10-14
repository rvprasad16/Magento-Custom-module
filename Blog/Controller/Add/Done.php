<?php

namespace Toptal\Blog\Controller\Add;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Controller\ResultFactory;

class Done extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

protected $resource;

    protected $connection;
protected $resultRedirect;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     *
     * @codeCoverageIgnore
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
	ResourceConnection $resource,
	ResultFactory $result
    ) {
	$this->resource= $resource;
        $this->connection= $resource->getConnection();
	$this->resultPageFactory = $resultPageFactory;
	$this->resultRedirect = $result;
        parent::__construct(
            $context
        );
    }

    /**
     * Prints the blog from informed order id
     * @return Page
     * @throws LocalizedException
     */
    public function execute()
    {
	// 1. POST request : Get booking data 
	$post = (array) $this->getRequest()->getPost();
 
        if (!empty($post)) {
            // Retrieve your form data
            $title   = $post['title'];
            $content    = $post['content'];

		try {
            $yourData = [
                ['title' => $title, 'content' => $content]
            ];

            $tableName = 'toptal_blog_post';
            $this->insertMultiple($tableName, $yourData);

            //$this->messageManager->addSuccess( __('Successfully inserted data.') );
        } catch (Exception $e) {
            //$this->messageManager->addException($e, __('Cannot save data.'));
        }
            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/blog/index/index');
 
            return $resultRedirect;
    //    }
        // 2. GET request : Render the booking page 
        //$this->_view->loadLayout();
        //$this->_view->renderLayout();
    }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }


	public function insertMultiple($table, $data)
    {
        //try {
            $tableName = $this->resource->getTableName($table);
            return $this->connection->insertMultiple($tableName, $data);
        //} catch (\Exception $e) {
            //$this->messageManager->addException($e, __('Cannot insert data.'));
        //}
    }


}
