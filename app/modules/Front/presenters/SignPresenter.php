<?php

namespace App\FrontModule\Presenters;

use App\Forms\TemplateControl;
use Nette,
	App\Forms\SignFormFactory;


/**
 * Sign in/out presenters.
 * @resource Front:Sign
 */
class SignPresenter extends BasePresenter
{

	/** @var \App\Forms\ISignUpFormFactory @inject */
	public $signUpFormFactory;

	/** @var \App\Forms\ISendPasswordFormFactory @inject */
	public $sendPasswordFormFactory;


	protected $passwordResetRow;


	public function actionIn($newpasshash = "")
	{

		if ($newpasshash) {
			$this->passwordResetRow = $this->passwordResetRepository->findOneBy([
				"hash" => $newpasshash
			]);

			if (!$this->passwordResetRow) {
				$this->flashMessage("We are sorry, but this link is not valid. Maybe it is broken or expired.");
			}
		}

	}



	/**
	 * Sign-up form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignUpForm()
	{
		$form = $this->signUpFormFactory->create();
		$form->onFormSuccess[] = function ($form) {
			$form->getPresenter()->redirect(':Front:Sign:in');
		};
		return $form;
	}

	/**
	 * Reset password form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSendPasswordForm()
	{
		$form = $this->sendPasswordFormFactory->create();
		$form->onFormSuccess[] = function ($form) {
			$form->getPresenter()->redirect(':Front:Homepage:');
		};
		return $form;
	}


}
