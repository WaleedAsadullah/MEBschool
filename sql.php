SELECT `type`, `account_title`, SUM(`exp_amount`) FROM `ac_rev_exp` WHERE `date_of_rev_exp` <= '2021-08-20' AND `date_of_rev_exp` >= '2019-08-20' GROUP BY `account_title`
SELECT `type`, `account_title`, SUM(`exp_amount`) FROM `ac_rev_exp` WHERE `type` = 'Expenses' AND `date_of_rev_exp` <= '2021-08-20' AND `date_of_rev_exp` >= '2019-08-20' GROUP BY `account_title`