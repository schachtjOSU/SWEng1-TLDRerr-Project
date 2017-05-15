-- Legal term table with the following properties:
-- LegalNum - an auto incrementing integer which is the primary key
-- TCName - a varchar with a maximum length of 255 chars, cannot be null.  Word or Phrase string
-- LegalDef - a varchar with max of 1000 chars.  Legal definition string of the TCName for reference.
-- LegalSource - a varchar with max of 1000 chars.  Optional string to source reference of legal term and definition.
-- TLDerrDef - a varchar with max of 1000 chars.  TLDerr's definition of the TCName.
-- Entryname - a varchar with max of 255 chars.  Not null for person making entry or edit
-- LastUpdate - Date object.  Optional for the date of the last update.

SET FOREIGN_KEY_CHECKS=0;

-- table `legal` commented out since it exists already with data.

-- DROP TABLE IF EXISTS `legal`;
-- CREATE TABLE `legal` (
-- 	`LegalNum` int(11) NOT NULL AUTO_INCREMENT,
-- 	`TCName` varchar(255) NOT NULL,
-- 	`LegalDef` varchar(1000),
-- 	`LegalSource` varchar(1000),
-- 	`TLDerrDef` varchar(1000),
-- 	`Entryname` varchar(255) NOT NULL,
-- 	`LastUpdate` DATE NOT NULL,
-- 	PRIMARY KEY (`LegalNum`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `document`;
CREATE TABLE `document` (
	`DocId` int(11) NOT NULL AUTO_INCREMENT,
	`DocName` varchar(255) NOT NULL,
	PRIMARY KEY (`DocId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `document_term`;
CREATE TABLE `document_term` (
	`DocId` int NOT NULL,
	`TermId` int NOT NULL,
	PRIMARY KEY `DocTermId` (`DocId`, `TermId`),
	FOREIGN KEY (`DocId`) REFERENCES `document` (`DocId`),
	FOREIGN KEY (`TermId`) REFERENCES `legal` (`LegalNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `expert_rating`;
CREATE TABLE `expert_review` (
	`ReviewId` int(11) NOT NULL AUTO_INCREMENT,
	`Document` int(11) NOT NULL,
	`Rating` int(11) NOT NULL,
	`UserRate`int(11) NOT NULL DEFAULT 0,
	PRIMARY KEY (`ReviewId`),
	FOREIGN KEY (`Document`) REFERENCES `document` (`DocId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;