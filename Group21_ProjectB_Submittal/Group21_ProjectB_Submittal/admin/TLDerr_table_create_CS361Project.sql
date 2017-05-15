-- Legal term table with the following properties:
-- LegalNum - an auto incrementing integer which is the primary key
-- TCName - a varchar with a maximum length of 255 chars, cannot be null.  Word or Phrase string
-- LegalDef - a varchar with max of 1000 chars.  Legal definition string of the TCName for reference.
-- LegalSource - a varchar with max of 1000 chars.  Optional string to source reference of legal term and definition.
-- TLDerrDef - a varchar with max of 1000 chars.  TLDerr's definition of the TCName.
-- Entryname - a varchar with max of 255 chars.  Not null for person making entry or edit
-- LastUpdate - Date object.  Optional for the date of the last update.

DROP TABLE IF EXISTS `legal`;
CREATE TABLE `legal` (
	`LegalNum` int(11) NOT NULL AUTO_INCREMENT,
	`TCName` varchar(255) NOT NULL,
	`LegalDef` varchar(1000),
	`LegalSource` varchar(1000),
	`TLDerrDef` varchar(1000),
	`Entryname` varchar(255) NOT NULL,
	`LastUpdate` DATE NOT NULL,
	PRIMARY KEY (`LegalNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;