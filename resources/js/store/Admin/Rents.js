import { defineStore } from "pinia";
import axios from 'axios';
import { ref, computed } from "vue";

export const useRentsIndex = defineStore('rents-index', () => {
    let columnNames = ref([]);
    let rowDatas = ref({});
    let filteredRowDatas = ref({});
    let tableRentsTransition = ref(false);
    let categoriesList = ref([]);
    let statusRentsList = ref([]);

    //Metodos
    const index = async () => {
        try {
            const { data } = await axios.get('http://etbsa-rentas.test/api/RentsListAPI');
            columnNames.value = [...data.columnNames];
            rowDatas.value = { ...data.rowDatas };
            filteredRowDatas.value = rowDatas.value.data;
            categoriesList.value = [...data.categories];
            statusRentsList.value = [...data.statusRents];
            tableRentsTransition.value = !tableRentsTransition.value;
        } catch (error) {
            console.error(error);
        }
    };

    //Filtros especificos
    const filterRentsByEquipmentNoSerie = (rowData, queryEquipmentNoSerie) => {
        return (
            queryEquipmentNoSerie == '' ||
            queryEquipmentNoSerie == null ||
            rowData.equipment.noSerieEquipo.toLowerCase().includes(queryEquipmentNoSerie.toLowerCase())
        );
    };
    const filterRentsByClientName = (rowData, queryClientName) => {
        return (
            queryClientName == '' ||
            queryClientName == null ||
            rowData.person.nombrePersona.toLowerCase().includes(queryClientName.toLowerCase())
        );
    };
    const filterRentsByClientAP = (rowData, queryClientAP) => {
        return (
            queryClientAP == '' ||
            queryClientAP == null ||
            rowData.person.apePaternoPersona.toLowerCase().includes(queryClientAP.toLowerCase())
        );
    };
    const filterRentsByClientAM = (rowData, queryClientAM) => {
        return (
            queryClientAM == '' ||
            queryClientAM == null ||
            rowData.person.apeMaternoPersona.toLowerCase().includes(queryClientAM.toLowerCase())
        );
    };
    const filterRentsByEquipmentCategory = (rowData, queryEquipmentCategory) => {
        return (
            queryEquipmentCategory == '' ||
            queryEquipmentCategory == null ||
            rowData.equipment.categoria.categoria.toLowerCase().includes(queryEquipmentCategory.toLowerCase())
        );
    };
    const filterRentsByRentSatus = (rowData, queryStatusRent) => {
        return (
            queryStatusRent == '' ||
            queryStatusRent == null ||
            rowData.status_rent.estadoRenta.toLowerCase().includes(queryStatusRent.toLowerCase())
        );
    };
    //Filtro General
    const filterRents = (queryEquipmentNoSerie, queryClientName, queryClientAP, queryClientAM, queryEquipmentCategory, queryStatusRent) => {
        filteredRowDatas.value = rowDatas.value.data.filter(rowData => {
            return (
                filterRentsByEquipmentNoSerie(rowData, queryEquipmentNoSerie) &&
                filterRentsByClientName(rowData, queryClientName) &&
                filterRentsByClientAP(rowData, queryClientAP) &&
                filterRentsByClientAM(rowData, queryClientAM) &&
                filterRentsByEquipmentCategory(rowData, queryEquipmentCategory) &&
                filterRentsByRentSatus(rowData, queryStatusRent)
            );
        });
    };

    return {
        columnNames,
        rowDatas,
        filteredRowDatas,
        categoriesList,
        statusRentsList,
        tableRentsTransition,
        index,
        filterRentsByEquipmentNoSerie,
        filterRentsByClientName,
        filterRentsByClientAP,
        filterRentsByClientAM,
        filterRentsByEquipmentCategory,
        filterRentsByRentSatus,
        filterRents
    };
});