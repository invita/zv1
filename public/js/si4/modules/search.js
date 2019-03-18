si4.modules.search = function(args) {

    //console.log("search", args)

    this.container = new si4.widget.si4Element({ parent: si4.data.contentElement, tagClass: "defContainer moduleSearch" });

    this.dataTable = new si4.widget.si4DataTable({
        parent: this.container.selector,
        primaryKey: ['ID'],
        //entityTitleNew: si4.lookup[name].entityTitleNew,
        //entityTitleEdit: si4.lookup[name].entityTitleEdit,
        filter: { visible: true },
        dataSource: new si4.widget.si4DataTableDataSource({
            moduleName: "search",
            select: si4.api.search,
            staticData : { q: args.q },
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
            //console.log("rowValue", rowValue);

            var paramId = rowValue.ID;
            if (rowValue.PRIIMEK) paramId += "-"+rowValue.PRIIMEK;
            if (rowValue.IME) paramId += "-"+rowValue.IME;
            if (rowValue.ROJSTVO_LETO) paramId += "-"+rowValue.ROJSTVO_LETO;
            if (rowValue.SMRT_LETO) paramId += "-"+rowValue.SMRT_LETO;

            si4.navigation.switchPage("zrtev", { id: paramId });
        },
        //tabPage: args.contentTab,
        fields: {
            ID: { caption: "Id" },
            PRIIMEK: { caption: si4.translate("field_PRIIMEK"), canSort: true, canFilter: true },
            IME: { caption: si4.translate("field_IME"), canSort: true, canFilter: true },
            ROJSTVO: { caption: si4.translate("field_ROJSTVO"), canSort: true, canFilter: true },
            SMRT: { caption: si4.translate("field_SMRT"), canSort: true, canFilter: true },
            BIVALISCE: { caption: si4.translate("field_BIVALISCE"), canSort: true, canFilter: true },
            DEZELA: { caption: si4.translate("field_DEZELA"), canSort: true, canFilter: true },
            ENOTA: { caption: si4.translate("field_ENOTA"), canSort: true, canFilter: true },
        },
        fieldOrder: "definedFields",
        showOnlyDefinedFields: true,
        maxRecordCount: 10000,
        replaceUrlPagination: true,
        //cssClass_table: "si4DataTable_table width100percent"
    });
};