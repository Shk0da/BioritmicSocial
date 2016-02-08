<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Main Page, with not login');
$I->amOnPage('/');
$I->see('Мы поможем Вам найти свой идеал');
