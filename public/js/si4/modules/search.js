si4.modules.search = function(args) {

    //console.log("search", args)

    this.container = new si4.widget.si4Element({ parent: args.parent, tagClass: "defContainer moduleSearch" });


    this.dataTable = new si4.widget.si4DataTable({
        parent: this.container.selector,
        primaryKey: ['ID'],
        //entityTitleNew: si4.lookup[name].entityTitleNew,
        //entityTitleEdit: si4.lookup[name].entityTitleEdit,
        //filter: { enabled: false },
        dataSource: new si4.widget.si4DataTableDataSource({
            moduleName: "search",
            select: si4.api.search,
            staticData : { search: args.search },
            pageCount: 20
        }),
        editorModuleArgs: {
            //moduleName:"Entities/EntityDetails",
            //caller: "entityList"
        },
        canInsert: false,
        canDelete: false,
        selectCallback: function(selArgs) {
            var rowValue = selArgs.row.getValue();
            // rowValue.ID
            //si4.navigation.switchPage("zrtev", { id: rowValue.ID });
            si4.navigation.switchPage("zrtev", { row: rowValue });

        },
        //tabPage: args.contentTab,
        fields: {
            ID: { caption: "Id" },
            PRIIMEK: { caption: si4.translate("field_PRIIMEK"), canSort: false, canFilter: true },
            IME: { caption: si4.translate("field_IME"), canSort: false, canFilter: true },
            ROJSTVO: { caption: si4.translate("field_ROJSTVO"), canSort: false, canFilter: true },
            SMRT: { caption: si4.translate("field_SMRT"), canSort: false, canFilter: true },
            BIVALISCE: { caption: si4.translate("field_BIVALISCE"), canSort: false, canFilter: true },

            CIN: { visible: false },
            PRIIMEK2: { visible: false },
            STARSI: { visible: false },
            DEZELA: { visible: false },
            DOMOVINSKA: { visible: false },
            ENOTA: { visible: false },
            IZVOR: { visible: false },
            KRAJ_ROJSTVA: { visible: false },
            KRAJ_SMRTI: { visible: false },
            OBCINA: { visible: false },
            OPOMBE: { visible: false },
            OSTALO: { visible: false },
            POKOP: { visible: false },
            STAN: { visible: false },
            VIRI: { visible: false },
            VPOKLIC: { visible: false },
            VZROK: { visible: false },
            ZUPNIJA: { visible: false },


            /*
            entity_type_name: { caption: si4.translate("field_entityType"), valueTranslatePrefix:"et_" },

            //name: { caption: "Naziv" },
            //description: { caption: "Opis" },
            title: { maxCharLength: 100 },
            creator: { caption: si4.translate("field_creators"), maxCharLength: 50 },

            entity_type_id: { visible: false },
            data: { visible: false },
            */
        },
        //cssClass_table: "si4DataTable_table width100percent"
    });
};