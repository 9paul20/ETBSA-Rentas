import { defineStore } from "pinia";
import axios from 'axios';
import { ref } from "vue";

export const equipments = defineStore('equipments', () => {
    const listStatus = ref();
    const listCategories = ref();
    const datePickerFormat = 'yyyy-MM-dd';
    const formatDate = (date) => {
        if (date) {
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;
            return formattedDate;
        }
        else {
            return '';
        }
    }
    //modelos
    const equipment = ref({
        noSerieEquipo: '',
        noSerieMotor: '',
        noEconomico: '',
        modelo: '',
        clvDisponibilidad: '',
        clvCategoria: '',
        descripcion: '',
        precioEquipo: '',
        precioEquipoActual: '',
        precioActualVenta: '',
        folioEquipo: '',
        fechaAdquisicion: '',
        fechaGarantiaExtendida: '',
        fechaVenta: '',
        porDeprAnual: '',
    });
    const errors = ref({
        noSerieEquipo: '',
        noSerieMotor: '',
        noEconomico: '',
        modelo: '',
        clvDisponibilidad: '',
        clvCategoria: '',
        descripcion: '',
        precioEquipo: '',
        precioEquipoActual: '',
        precioActualVenta: '',
        folioEquipo: '',
        fechaAdquisicion: '',
        fechaGarantiaExtendida: '',
        fechaVenta: '',
        porDeprAnual: '',
    });
    const fixedExpense = ref({
        gastoFijo: '',
        costoGastoFijo: '',
        folioFactura: '',
        fechaGastoFijo: '',
        clvTipoGastoFijo: '',
        clvEquipo: '',
    });
    const editFixedExpense = ref({
        gastoFijo: '',
        costoGastoFijo: '',
        folioFactura: '',
        fechaGastoFijo: '',
        clvTipoGastoFijo: '',
        clvEquipo: '',
    });
    const fixedExpenseErrors = ref({
        clvGastoFijo: '',
        gastoFijo: '',
        costoGastoFijo: '',
        folioFactura: '',
        fechaGastoFijo: '',
        clvTipoGastoFijo: '',
        clvEquipo: '',
    });
    const fixedExpenseUpdateErrors = ref({
        clvGastoFijo: '',
        gastoFijo: '',
        costoGastoFijo: '',
        folioFactura: '',
        fechaGastoFijo: '',
        clvTipoGastoFijo: '',
        clvEquipo: '',
    });
    let Data = ref({});
    let filteredRowDatas = ref({});
    let clvDisponibilidadValue = '';
    let clvCategoriaValue = '';
    let clvTipoGastoFijoValue = '';
    //Metodos
    const getStatus = async () => {
        try {
            listStatus.value = await axios.get('http://etbsa-rentas.test/api/StatusListAPI');
            listStatus.value = listStatus.value.data;
        } catch (error) {
            console.error(error);
        }
    };
    const getCategories = async () => {
        try {
            listCategories.value = await axios.get('http://etbsa-rentas.test/api/CategoriesListAPI');
            listCategories.value = listCategories.value.data;
        } catch (error) {
            console.error(error);
        }
    };
    const clvs = (clvDisponibilidad, clvCategoria, clvTipoGastoFijo) => {
        clvDisponibilidadValue = clvDisponibilidad;
        clvCategoriaValue = clvCategoria;
        clvTipoGastoFijoValue = clvTipoGastoFijo;
    };
    //*Metodos Resource
    const index = async () => {
        try {
            const { data } = await axios.get('http://etbsa-rentas.test/api/EquipmentsListAPI');
            Data.value = {
                columnNames: [...data.columnNames],
                rowDatas: { ...data.rowDatas },
            };
            filteredRowDatas.value = Data.value.rowDatas.data;
        } catch (error) {
            console.error(error);
        }
    };

    const store = async () => {
        //Constantes para almacenar valores
        const fechaAdquisicion = equipment.value.fechaAdquisicion;
        const fechaGarantiaExtendida = equipment.value.fechaGarantiaExtendida;
        const formattedFechaAdquisicion = formatDate(fechaAdquisicion);
        const formattedFechaGarantiaExtendida = formatDate(fechaGarantiaExtendida);
        //Asignación de los valores formateados
        equipment.value.fechaAdquisicion = formattedFechaAdquisicion;
        equipment.value.fechaGarantiaExtendida = formattedFechaGarantiaExtendida;
        //Asignación de los listBox correspondientes
        equipment.value.clvDisponibilidad = clvDisponibilidadValue;
        equipment.value.clvCategoria = clvCategoriaValue;

        // console.log(equipment.value);

        try {
            const response = await axios.post('http://etbsa-rentas.test/api/EquipmentsListAPI', equipment.value)
                .then(res => {
                    console.log(res);
                });
        } catch (error) {
            if (error.response.data) {
                console.error(error.response.data);
                if (error.response.data.errors.noSerieEquipo)
                    errors.value.noSerieEquipo = error.response.data.errors.noSerieEquipo;
                if (error.response.data.errors.noSerieMotor)
                    errors.value.noSerieMotor = error.response.data.errors.noSerieMotor;
                if (error.response.data.errors.noEconomico)
                    errors.value.noEconomico = error.response.data.errors.noEconomico;
                if (error.response.data.errors.modelo)
                    errors.value.modelo = error.response.data.errors.modelo;
                if (error.response.data.errors.clvDisponibilidad)
                    errors.value.clvDisponibilidad = error.response.data.errors.clvDisponibilidad;
                if (error.response.data.errors.clvCategoria)
                    errors.value.clvCategoria = error.response.data.errors.clvCategoria;
                if (error.response.data.errors.descripcion)
                    errors.value.descripcion = error.response.data.errors.descripcion;
                if (error.response.data.errors.precioEquipo)
                    errors.value.precioEquipo = error.response.data.errors.precioEquipo;
                if (error.response.data.errors.precioEquipoActual)
                    errors.value.precioEquipoActual = error.response.data.errors.precioEquipoActual;
                if (error.response.data.errors.precioActualVenta)
                    errors.value.precioActualVenta = error.response.data.errors.precioActualVenta;
                if (error.response.data.errors.folioEquipo)
                    errors.value.folioEquipo = error.response.data.errors.folioEquipo;
                if (error.response.data.errors.fechaAdquisicion)
                    errors.value.fechaAdquisicion = error.response.data.errors.fechaAdquisicion;
                if (error.response.data.errors.fechaGarantiaExtendida)
                    errors.value.fechaGarantiaExtendida = error.response.data.errors.fechaGarantiaExtendida;
                if (error.response.data.errors.fechaVenta)
                    errors.value.fechaVenta = error.response.data.errors.fechaVenta;
                if (error.response.data.errors.porDeprAnual)
                    errors.value.porDeprAnual = error.response.data.errors.porDeprAnual;
            }
        }

        //Asignación de valores originales(Necesario para volver a enviar el formulario en Date(), en caso de formular mal los datos)
        equipment.value.fechaAdquisicion = fechaAdquisicion;
        equipment.value.fechaGarantiaExtendida = fechaGarantiaExtendida;
    };

    const storeFixedExpense = async (id) => {
        //Constantes para almacenar valores
        const getFechaGastoFijo = fixedExpense.value.fechaGastoFijo;
        const formattedFechaGastoFijo = formatDate(getFechaGastoFijo);
        //Asignación de los valores formateados
        fixedExpense.value.fechaGastoFijo = formattedFechaGastoFijo;
        //Asignación de los listBox correspondientes
        fixedExpense.value.clvTipoGastoFijo = clvTipoGastoFijoValue;
        fixedExpense.value.clvEquipo = id;

        try {
            const response = await axios.post(`http://etbsa-rentas.test/api/FixedExpensesEquipmentsAPI/${id}`, fixedExpense.value)
                .then(res => {
                    console.log(res);
                });
        } catch (error) {
            if (error.response.data) {
                console.error(error.response.data);
                if (error.response.data.errors.gastoFijo)
                    fixedExpenseErrors.value.gastoFijo = error.response.data.errors.gastoFijo;
                if (error.response.data.errors.costoGastoFijo)
                    fixedExpenseErrors.value.costoGastoFijo = error.response.data.errors.costoGastoFijo;
                if (error.response.data.errors.folioFactura)
                    fixedExpenseErrors.value.folioFactura = error.response.data.errors.folioFactura;
                if (error.response.data.errors.fechaGastoFijo)
                    fixedExpenseErrors.value.fechaGastoFijo = error.response.data.errors.fechaGastoFijo;
                if (error.response.data.errors.clvTipoGastoFijo)
                    fixedExpenseErrors.value.clvTipoGastoFijo = error.response.data.errors.clvTipoGastoFijo;
            }
        }

        //Asignación de valores originales(Necesario para volver a enviar el formulario en Date(), en caso de formular mal los datos)
        fixedExpense.value.fechaGastoFijo = getFechaGastoFijo;
    };

    const show = async (id) => {
        try {
            const response = await axios.get(`http://etbsa-rentas.test/api/EquipmentsListAPI/${id}`)
                .then(res => {
                    console.log(res);
                });
        } catch (error) {
            console.error(error);
        }
    }

    const edit = async (id) => {
        try {
            const response = await axios.get(`http://etbsa-rentas.test/api/EquipmentEditAPI/${id}`);
            //De preferencia hay que definir más exacto el modelo, ya que si asigno a equipment el valor response.data.equipment
            //va traer todos los datos incluyendo los gastos, que en mi caso aquí no ocupo
            equipment.value = {
                noSerieEquipo: response.data.equipment.noSerieEquipo,
                noSerieMotor: response.data.equipment.noSerieMotor,
                noEconomico: response.data.equipment.noEconomico,
                modelo: response.data.equipment.modelo,
                clvDisponibilidad: response.data.equipment.clvDisponibilidad,
                clvCategoria: response.data.equipment.clvCategoria,
                descripcion: response.data.equipment.descripcion,
                precioEquipo: response.data.equipment.precioEquipo,
                precioEquipoActual: response.data.equipment.precioEquipoActual,
                precioActualVenta: response.data.equipment.precioActualVenta,
                folioEquipo: response.data.equipment.folioEquipo,
                fechaAdquisicion: response.data.equipment.fechaAdquisicion,
                fechaGarantiaExtendida: response.data.equipment.fechaGarantiaExtendida,
                fechaVenta: response.data.equipment.fechaVenta,
                porDeprAnual: response.data.equipment.porDeprAnual,
            };
            return response.data;
        } catch (error) {
            console.error(error);
        }
    }

    const update = async (
        id,
        noSerieEquipo,
        noSerieMotor,
        noEconomico,
        modelo,
        precioEquipo,
        precioEquipoActual,
        precioActualVenta,
        clvDisponibilidad,
        clvCategoria,
        folioEquipo,
        fechaAdquisicion,
        fechaGarantiaExtendida,
        fechaVenta,
        porDeprAnual,
        descripcion,
    ) => {
        let getFechaAdquisicion, formattedFechaAdquisicion, getFechaGarantiaExtendida, formattedFechaGarantiaExtendida, getFechaVenta, formattedFechaVenta;
        //Si se envia un valor diferente de disponibilidad desde el formulario, se reemplaza en el modelo equipment, de no ser así, se usa el valor original y no se realiza ningun cambio
        (clvDisponibilidad !== null) ? equipment.value.clvDisponibilidad = clvDisponibilidad : null;
        //Si se envia un valor diferente de categoria desde el formulario, se reemplaza en el modelo equipment, de no ser así, se usa el valor original y no se realiza ningun cambio
        (clvCategoria !== null) ? equipment.value.clvCategoria = clvCategoria : null;
        //si fechaAdquisicion es diferente al valor original de equipment, se modifica, de no ser así, se usa el valor original
        if (fechaAdquisicion !== equipment.value.fechaAdquisicion) {
            getFechaAdquisicion = fechaAdquisicion;
            formattedFechaAdquisicion = formatDate(fechaAdquisicion);
            equipment.value.fechaAdquisicion = formattedFechaAdquisicion;
            //Regresar su valor original para una futura validación si es que llega a necesitarse
            fechaAdquisicion = getFechaAdquisicion;
        }
        else
            equipment.value.fechaAdquisicion = fechaAdquisicion;
        //si fechaGarantiaExtendida es diferente al valor original de equipment, se modifica, de no ser así, se usa el valor original
        if (fechaGarantiaExtendida !== equipment.value.fechaGarantiaExtendida) {
            getFechaGarantiaExtendida = fechaGarantiaExtendida;
            formattedFechaGarantiaExtendida = formatDate(fechaGarantiaExtendida);
            equipment.value.fechaGarantiaExtendida = formattedFechaGarantiaExtendida;
            //Regresar su valor original para una futura validación si es que llega a necesitarse
            fechaAdquisicion = getFechaAdquisicion;
        }
        else
            equipment.value.fechaGarantiaExtendida = fechaGarantiaExtendida;
        //si fechaVenta es diferente al valor original de equipment, se modifica, de no ser así, se usa el valor original
        if (!fechaVenta == equipment.value.fechaVenta) {
            getFechaVenta = fechaVenta;
            formattedFechaVenta = formatDate(fechaVenta);
            equipment.value.fechaVenta = formattedFechaVenta;
            //Regresar su valor original para una futura validación si es que llega a necesitarse
            fechaAdquisicion = getFechaAdquisicion;
        }
        else
            equipment.value.fechaVenta = fechaVenta;
        //Datos que no necesitan una validación o parametros especificos aun que en caso de ser modificados, hay que mandar los nuevos cambios
        //No es necesario identificar si hay cambios en los campos de los valores originales a los nuevos,
        //Por ser campos de texto plano, es más que suficiente de la siguiente manera
        equipment.value.noSerieEquipo = noSerieEquipo;
        equipment.value.noSerieMotor = noSerieMotor;
        equipment.value.noEconomico = noEconomico;
        equipment.value.modelo = modelo;
        equipment.value.precioEquipo = precioEquipo;
        equipment.value.precioEquipoActual = precioEquipoActual;
        equipment.value.precioActualVenta = precioActualVenta;
        equipment.value.folioEquipo = folioEquipo;
        equipment.value.porDeprAnual = porDeprAnual;
        equipment.value.descripcion = descripcion;
        try {
            const response = await axios.put(`http://etbsa-rentas.test/api/EquipmentsListAPI/${id}`, equipment.value)
                .then(res => {
                    console.log(res);
                });
        } catch (error) {
            if (error.response.data) {
                console.error(error.response.data);
                if (error.response.data.errors.noSerieEquipo)
                    errors.value.noSerieEquipo = error.response.data.errors.noSerieEquipo;
                if (error.response.data.errors.noSerieMotor)
                    errors.value.noSerieMotor = error.response.data.errors.noSerieMotor;
                if (error.response.data.errors.noEconomico)
                    errors.value.noEconomico = error.response.data.errors.noEconomico;
                if (error.response.data.errors.modelo)
                    errors.value.modelo = error.response.data.errors.modelo;
                if (error.response.data.errors.clvDisponibilidad)
                    errors.value.clvDisponibilidad = error.response.data.errors.clvDisponibilidad;
                if (error.response.data.errors.clvCategoria)
                    errors.value.clvCategoria = error.response.data.errors.clvCategoria;
                if (error.response.data.errors.descripcion)
                    errors.value.descripcion = error.response.data.errors.descripcion;
                if (error.response.data.errors.precioEquipo)
                    errors.value.precioEquipo = error.response.data.errors.precioEquipo;
                if (error.response.data.errors.precioEquipoActual)
                    errors.value.precioEquipoActual = error.response.data.errors.precioEquipoActual;
                if (error.response.data.errors.precioActualVenta)
                    errors.value.precioActualVenta = error.response.data.errors.precioActualVenta;
                if (error.response.data.errors.folioEquipo)
                    errors.value.folioEquipo = error.response.data.errors.folioEquipo;
                if (error.response.data.errors.fechaAdquisicion)
                    errors.value.fechaAdquisicion = error.response.data.errors.fechaAdquisicion;
                if (error.response.data.errors.fechaGarantiaExtendida)
                    errors.value.fechaGarantiaExtendida = error.response.data.errors.fechaGarantiaExtendida;
                if (error.response.data.errors.fechaVenta)
                    errors.value.fechaVenta = error.response.data.errors.fechaVenta;
                if (error.response.data.errors.porDeprAnual)
                    errors.value.porDeprAnual = error.response.data.errors.porDeprAnual;
            }
        }
    }

    const updateFixedExpense = async (
        id,
        gastoFijo,
        costoGastoFijo,
        folioFactura,
        fechaGastoFijo,
        clvTipoGastoFijo,
    ) => {
        let getFechaGastoFijo, formattedFechaGastoFijo;
        //Si se envia un valor diferente de disponibilidad desde el formulario, se reemplaza en el modelo equipment, de no ser así, se usa el valor original y no se realiza ningun cambio
        (clvTipoGastoFijo !== null) ? fixedExpense.value.clvTipoGastoFijo = clvTipoGastoFijo : null;
        //si fechaGastoFijo es diferente al valor original de fixedExpense, se modifica, de no ser así, se usa el valor original
        if (fechaGastoFijo !== fixedExpense.value.fechaGastoFijo) {
            getFechaGastoFijo = fechaGastoFijo;
            formattedFechaGastoFijo = formatDate(fechaGastoFijo);
            fixedExpense.value.fechaGastoFijo = formattedFechaGastoFijo;
            //Regresar su valor original para una futura validación si es que llega a necesitarse
            fechaGastoFijo = getFechaGastoFijo;
        }
        else
            fixedExpense.value.fechaGastoFijo = fechaGastoFijo;
        //Datos que no necesitan una validación o parametros especificos aun que en caso de ser modificados, hay que mandar los nuevos cambios
        //No es necesario identificar si hay cambios en los campos de los valores originales a los nuevos,
        //Por ser campos de texto plano, es más que suficiente de la siguiente manera
        fixedExpense.value.gastoFijo = gastoFijo;
        fixedExpense.value.costoGastoFijo = costoGastoFijo;
        fixedExpense.value.folioFactura = folioFactura;
        try {
            const response = await axios.put(`http://etbsa-rentas.test/api/FixedExpensesEquipmentsAPI/${id}`, fixedExpense.value)
                .then(res => {
                    console.log(res);
                });
        } catch (error) {
            if (error.response.data) {
                console.error(error.response.data);
                if (error.response.data.errors.gastoFijo)
                    fixedExpenseUpdateErrors.value.gastoFijo = error.response.data.errors.gastoFijo;
                if (error.response.data.errors.costoGastoFijo)
                    fixedExpenseUpdateErrors.value.costoGastoFijo = error.response.data.errors.costoGastoFijo;
                if (error.response.data.errors.folioFactura)
                    fixedExpenseUpdateErrors.value.folioFactura = error.response.data.errors.folioFactura;
                if (error.response.data.errors.fechaGastoFijo)
                    fixedExpenseUpdateErrors.value.fechaGastoFijo = error.response.data.errors.fechaGastoFijo;
                if (error.response.data.errors.clvTipoGastoFijo)
                    fixedExpenseUpdateErrors.value.clvTipoGastoFijo = error.response.data.errors.clvTipoGastoFijo;
            }
        }
    }

    //Filtros especificos
    const filterEquipmentsByNoSerieEquipo = (rowData, queryEquipmentNoSerieEquipo) => {
        return (
            queryEquipmentNoSerieEquipo == '' ||
            queryEquipmentNoSerieEquipo == null ||
            rowData.noSerieEquipo.toLowerCase().includes(queryEquipmentNoSerieEquipo.toLowerCase())
        );
    };
    const filterEquipmentsByModelo = (rowData, queryEquipmentModelo) => {
        return (
            queryEquipmentModelo == '' ||
            queryEquipmentModelo == null ||
            rowData.modelo.toLowerCase().includes(queryEquipmentModelo.toLowerCase())
        );
    };
    const filterEquipmentsByCategory = (rowData, queryEquipmentCategory) => {
        return (
            queryEquipmentCategory == '' ||
            queryEquipmentCategory == null ||
            rowData.categoria.categoria.toLowerCase().includes(queryEquipmentCategory.toLowerCase())
        );
    };
    const filterEquipmentsByStatus = (rowData, queryEquipmentStatus) => {
        return (
            queryEquipmentStatus == '' ||
            queryEquipmentStatus == null ||
            rowData.disponibilidad.disponibilidad.toLowerCase().includes(queryEquipmentStatus.toLowerCase())
        );
    };
    //Filtro General
    const filterEquipments = async (queryEquipmentNoSerieEquipo, queryEquipmentModelo, queryEquipmentCategory, queryEquipmentStatus) => {
        filteredRowDatas.value = Data.value.rowDatas.data.filter(rowData => {
            return (
                filterEquipmentsByNoSerieEquipo(rowData, queryEquipmentNoSerieEquipo) &&
                filterEquipmentsByModelo(rowData, queryEquipmentModelo) &&
                filterEquipmentsByCategory(rowData, queryEquipmentCategory) &&
                filterEquipmentsByStatus(rowData, queryEquipmentStatus)
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

    return {
        listStatus,
        listCategories,
        datePickerFormat,
        formatDate,
        equipment,
        errors,
        fixedExpense,
        editFixedExpense,
        fixedExpenseErrors,
        fixedExpenseUpdateErrors,
        Data,
        getStatus,
        getCategories,
        clvs,
        index,
        store,
        storeFixedExpense,
        show,
        edit,
        update,
        filterEquipmentsByNoSerieEquipo,
        filterEquipmentsByModelo,
        filterEquipmentsByCategory,
        filterEquipmentsByStatus,
        filterEquipments,
        filteredRowDatas,
        precioFormatter,
    };
});