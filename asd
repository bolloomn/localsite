insert into bayankhongor.posts SELECT `id`, 2, 0, `title_mon`, `full_mon`, `intro_mon`, concat('images/',`image`), 0, 1, 0, 0, 0, `date`, `date` FROM bns.`news` WHERE `menu_id` = 3 ORDER BY `id` DESC