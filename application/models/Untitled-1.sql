
SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,

			t2.total_qty + COALESCE(t8.request_quantity,0) - (COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date,COALESCE(t1.total_issue_qty,0) as tot_qty

			FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem  where master_status!=1 GROUP BY item_id_fk,branch_id_fk) t1


			RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk


			LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk

			LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk

			LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk