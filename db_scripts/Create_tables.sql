
SET AUTOCOMMIT = 0;
START TRANSACTION;


CREATE TABLE `Visionary_Game` (
  `CREATION_TIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID` bigint(20) NOT NULL,
  `CREATOR` varchar(250) NOT NULL COMMENT 'The User who created the game.',
  `STATE` varchar(100) NOT NULL COMMENT 'The state of the game.'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `Visionary_Game`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Visionary_Game`
  ADD PRIMARY KEY (`ID`);

CREATE TABLE `Visionary_Messages` (
  `GAME_ID` bigint(20) NOT NULL COMMENT 'the game to which the message belongs to',
  `USER_ID` varchar(250) NOT NULL COMMENT 'the user who posted the message',
  `MESSAGE` varchar(250) NOT NULL COMMENT 'the content of the message',
  `POSTTIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'the time when the message was posted'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `Visionary_User` (
  `NAME` varchar(50) NOT NULL,
  `ID` varchar(250) NOT NULL,
  `GAME_ID` bigint(20) NOT NULL COMMENT 'Users belong to games.',
  `POSITION` int(11) NOT NULL COMMENT 'To determine in which order the users take their turns. No two users for the same game must have the same position.'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `Visionary_User`
  ADD PRIMARY KEY (`ID`,`GAME_ID`);

CREATE TABLE `Visionary_Turns` (
  `GAME_ID` int(11) NOT NULL COMMENT 'the game to which the turn belongs to',
  `USER_ID` varchar(250) NOT NULL COMMENT 'the user whos turn it was',
  `NR` int(11) NOT NULL COMMENT 'the number of the turn',
  `ACTION` varchar(100) NOT NULL COMMENT 'The action which was performed in the turn. For example "play a card".',
  `DATA` varchar(100) NOT NULL COMMENT 'The data which was used for the action of the turn. For example the card which was played.'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `Visionary_Turns`
  ADD PRIMARY KEY (`GAME_ID`,`NR`);


-- COMMIT TRANSACTION
COMMIT;
