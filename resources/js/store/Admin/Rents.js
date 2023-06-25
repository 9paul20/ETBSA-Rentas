import { defineStore } from "pinia";
import axios from 'axios';
import { ref } from "vue";

export const rents = defineStore('rents', () => {
    let columnNames = ref([]);
    let rowDatas = ref({});
    let filteredRowDatas = ref({});
    let tableRentsTransition = ref(false);
    let categoriesList = ref([]);
    let statusRentsList = ref([]);
    let sumFirstPaymentsEnRenta = ref(0);
    let sumAllPaymentsByState = ref(0);
    let oldestStartDate = ref('');
    let lastestFinishDate = ref('');

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
            sumFirstPaymentsEnRenta.value = data.sumFirstPaymentsEnRenta;
            sumAllPaymentsByState.value = data.sumAllPaymentsByState;
            oldestStartDate.value = data.oldestStartDate;
            lastestFinishDate.value = data.lastestFinishDate;
        } catch (error) {
            console.error(error);
        }
    };

    const show = async ($id) => {
        try {
            const { data } = await axios.get('http://etbsa-rentas.test/api/RentsListAPI/'.$id);
            //
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
    const filterRentsByStartDate = (rowData, queryStartDate) => {
        // const startDate = new Date(queryStartDate);
        return !queryStartDate || rowData.fecha_inicio >= queryStartDate;
        // return (
        //     queryStartDate == '' ||
        //     queryStartDate == null ||
        //     rowData.status_rent.estadoRenta.toLowerCase().includes(queryStartDate.toLowerCase())
        // );
    };
    const filterRentsByEndDate = (rowData, queryEndDate) => {
        // const endDate = new Date(queryEndDate);
        return !queryEndDate || rowData.fecha_fin <= queryEndDate;
    };
    //Filtro General
    const filterRents = (queryEquipmentNoSerie, queryClientName, queryClientAP, queryClientAM, queryEquipmentCategory, queryStatusRent, queryStartDate, queryEndDate) => {
        filteredRowDatas.value = rowDatas.value.data.filter(rowData => {
            return (
                filterRentsByEquipmentNoSerie(rowData, queryEquipmentNoSerie) &&
                filterRentsByClientName(rowData, queryClientName) &&
                filterRentsByClientAP(rowData, queryClientAP) &&
                filterRentsByClientAM(rowData, queryClientAM) &&
                filterRentsByEquipmentCategory(rowData, queryEquipmentCategory) &&
                filterRentsByRentSatus(rowData, queryStatusRent) &&
                filterRentsByStartDate(rowData, queryStartDate) &&
                filterRentsByEndDate(rowData, queryEndDate)
            );
        });
    };
    //Funciones dedicadas
    function precioFormatter(Precio) {
        const formattedPrice = (Number(Precio)).toLocaleString('es-MX', {
            style: 'currency',
            currency: 'MXN',
        });
        return formattedPrice.replace('$', '');
    }
    function transformarFecha(fecha) {
        const meses = [
            "Ene", "Feb", "Mar", "Abr", "Mayo", "Jun",
            "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
        ];

        const partes = fecha.split("-");
        const dia = partes[2];
        const mes = meses[parseInt(partes[1]) - 1];
        const anio = partes[0];

        return `${dia} ${mes} de ${anio}`;
    }

    return {
        columnNames,
        rowDatas,
        filteredRowDatas,
        categoriesList,
        statusRentsList,
        sumFirstPaymentsEnRenta,
        sumAllPaymentsByState,
        oldestStartDate,
        lastestFinishDate,
        tableRentsTransition,
        index,
        show,
        filterRentsByEquipmentNoSerie,
        filterRentsByClientName,
        filterRentsByClientAP,
        filterRentsByClientAM,
        filterRentsByEquipmentCategory,
        filterRentsByRentSatus,
        filterRentsByStartDate,
        filterRentsByEndDate,
        filterRents,
        precioFormatter,
        transformarFecha,
    };
});