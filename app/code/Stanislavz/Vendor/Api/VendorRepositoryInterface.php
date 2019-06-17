<?php

namespace Stanislavz\Vendor\Api;

/**
 * @todo need to adapt code to my vendor
 * Interface VendorRepositoryInterface
 * @package Stanislavz\Venor\Api
 * @api
 */
interface VendorRepositoryInterface
{
    /**
     * Save question.
     *
     * @param \Stanislavz\AskQuestion\Api\Data\AskQuestionInterface $askQuestion
     * @return \Stanislavz\AskQuestion\Api\Data\AskQuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(AskQuestionInterface $askQuestion);
    /**
     * Retrieve question.
     *
     * @param int $questionId
     * @return \Stanislavz\AskQuestion\Api\Data\AskQuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($questionId);
    /**
     * Retrieve question matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Stanislavz\AskQuestion\Api\Data\AskQuestionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
    /**
     * Delete question.
     *
     * @param \Stanislavz\AskQuestion\Api\Data\AskQuestionInterface $askQuestion
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(AskQuestionInterface $askQuestion): bool;
    /**
     * Delete request sample by ID.
     *
     * @param int $questionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($questionId): bool;
}
