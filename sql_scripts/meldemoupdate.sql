INSERT INTO `trivia` (`show_id`, `fact`) VALUES ('1', 'In order to prepare for his role, Liam Neeson reportedly ate wolf jerky.');
INSERT INTO `trivia` (`show_id`, `fact`) VALUES ('1', 'According to actor Liam Neesons account, the temperatures were as low as -40°C in Smithers (British Columbia) where the film was shot. The snow storms/scenes were actual prevailing weather conditions and not a cinematic illusion produced with CGI trickery');
INSERT INTO `quotes` (`show_id`, `quote`) VALUES ('1', 'Ottway: [writing his suicide letter] There''s not a second that goes by when I''m not thinking of you in some way. I want to see your face. Feel your hands in mine. Feel you against me. But I know that will never be. You left me, and I can''t get you back... I move like I imagine the damned do, cursed. I feel like it''s only a matter of time... I don''t know why I''m writing this, I don''t know what can come of it. I know I can''t get you back. I don''t know why this has happened to us. I feel like it''s me. Bad luck. Poison. I''ve stopped doing this world any real good. ');
INSERT INTO `quotes` (`show_id`, `quote`) VALUES ('1', 'Ottway: Once more into the fray. Into the last good fight I''ll ever know. Live and die on this day. Live and die on this day. ');
INSERT INTO `goofs` (`show_id`, `goof`) VALUES ('1', 'In Prudhoe Bay, AK there are no wolves.');
INSERT INTO `goofs` (`show_id`, `goof`) VALUES ('1', 'In Prudhoe Bay, AK there are no bars.');
INSERT INTO `photos` (`show_id`, `url`) VALUES ('1', 'img/thegrey.jpg');

INSERT INTO `reviews` (`user_id`, `show_id`, `review`) VALUES
(13, 1, 'GREAT!'),
(14, 1, 'SUCKED!');

INSERT INTO `users` (`email`, `alias`, `password`, `critic`, `level`) VALUES
('melanie.przybylski@gmail.com', 'Melanie', '47a9f51805d48c49054615a4798eec201760dc96', 'Y', 'ADMINISTRATOR');

INSERT INTO `celeb_trivia` (`person_id`, `fact`) VALUES ('8', 'Was the only member of the Lara Croft: Tomb Raider (2001) cast to be a huge fan of the Tomb Raider video games. His favorite in the series was Tomb Raider II Starring Lara Croft (1997) (VG), released in 1997.');
INSERT INTO `people_quotes` (`person_id`, `quote`) VALUES ('8', 'As far as I''m concerned, I want to be nowhere else. It''s difficult in film because everybody wants to make a safe bet with roles. But if you are going to do stuff then you should be getting strong reactions. I don''t want audiences to be going, ''Yeah, that''s all right.''');
INSERT INTO `celeb_goofs` (`person_id`, `goof`) VALUES ('8', 'While incognito at a cinema in the USA, he was once asked if anyone had ever told him that he looked like Daniel Craig. He answered "no" and walked away.');

INSERT INTO `cast` (`actor_id`, `name`, `show_id`, `birth_date`) VALUES ('12', 'Liam Neeson', '1', '1952-06-07');