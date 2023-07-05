<template>
  <div class="min-h-full" v-if="equipmentObject">
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="border-t border-gray-200 py-3">
          <nav class="flex" aria-label="Breadcrumb">
            <div class="flex sm:hidden">
              <a
                href="#"
                class="group inline-flex space-x-3 text-sm font-medium text-gray-500 hover:text-gray-700"
              >
                <ArrowLongLeftIcon
                  class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-600"
                  aria-hidden="true"
                />
                <span>Back to Applicants</span>
              </a>
            </div>
            <div class="hidden sm:block">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                      <div class="flex flex-shrink-0 items-center px-4">
                        <img class="h-8 w-auto" :src="logo" alt="Your Company" />
                      </div>
                      <span class="sr-only">Home</span>
                    </a>
                  </div>
                </li>
                <li v-for="item in breadcrumbs" :key="item.name">
                  <div class="flex items-center">
                    <svg
                      class="h-5 w-5 flex-shrink-0 text-gray-300"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      aria-hidden="true"
                    >
                      <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <a
                      :href="item.href"
                      class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                      :aria-current="item.current ? 'page' : undefined"
                    >{{ item.name }}</a>
                  </div>
                </li>
              </ol>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <main class="py-10">
      <!-- Header de los detalles del equipo -->
      <div
        class="mx-auto max-w-3xl px-1 sm:px-1 md:flex md:items-center md:justify-between md:space-x-1 lg:max-w-7xl lg:px-1"
      >
        <div class="flex items-center space-x-5">
          <div class="flex-shrink-0">
            <div class="relative">
              <img class="h-16 rounded-full" :src="image_tractor" alt />
              <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true" />
            </div>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ equipmentObject.modelo }}</h1>
            <p class="text-sm font-medium text-gray-500">
              Con No.Serie
              <a class="text-gray-900">
                {{
                equipmentObject.noSerieEquipo }}.
              </a> Adquirido el día
              <time :datetime="equipmentObject.fechaAdquisicion">
                {{
                loader.transformarFecha(equipmentObject.fechaAdquisicion) }}
              </time>
              <span class="text-gray-400 font-light">
                ({{ mesesDespuesAdqEq }} meses desde su
                compra)
              </span>
            </p>
          </div>
        </div>
      </div>
      <div
        class="mx-auto mt-6 grid max-w-3xl grid-cols-1 gap-3 sm:px-6 lg:max-w-max lg:grid-flow-col-dense lg:grid-cols-3"
      >
        <div class="space-y-6 lg:col-span-2 lg:col-start-1">
          <!-- Lista informativa principal -->
          <section aria-labelledby="applicant-information-title">
            <div class="bg-white shadow sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                <h2
                  id="applicant-information-title"
                  class="text-lg font-medium leading-6 text-gray-900 text-center"
                >Información del equipo</h2>
                <p class="mt-1 text-sm text-gray-500">{{ equipmentObject.descripcion }}</p>
              </div>
              <div class="border-t border-gray-200 px-4 py-1 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-1 sm:grid-cols-4">
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Disponibilidad</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <span
                        :class="`inline-flex items-center gap-1 rounded-full ${equipmentObject.disponibilidad.bgColorPrimary} px-2 py-1 text-xl font-semibold ${equipmentObject.disponibilidad.textColor}`"
                      >
                        <span
                          :class="`h-1.5 w-1.5 rounded-full ${equipmentObject.disponibilidad.bgColorSecondary}`"
                        ></span>
                        {{ equipmentObject.disponibilidad.disponibilidad }}
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Categoria</dt>
                    <dd class="mt-1 text-xl text-gray-900">{{ equipmentObject.categoria.categoria }}</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Garantia Extendida</dt>
                    <dd
                      class="mt-1 text-xl text-gray-900"
                      v-if="equipmentObject.fechaGarantiaExtendida"
                    >
                      {{
                      loader.transformarFecha(equipmentObject.fechaGarantiaExtendida) }}
                    </dd>
                    <dd class="mt-1 text-xl text-gray-900" v-else>Sin garantia extendida</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Fecha de venta</dt>
                    <dd class="mt-1 text-xl text-gray-900" v-if="equipmentObject.fechaVenta">
                      {{
                      loader.transformarFecha(equipmentObject.fechaVenta) }}
                    </dd>
                    <dd class="mt-1 text-xl text-gray-900" v-else>Sin vender aún</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Precio de adquisición</dt>
                    <dd class="mt-1 text-xl text-gray-900">
                      <span class="text-green-600 font-semibold">$</span>
                      {{
                      loader.precioFormatter(precioEquipo) }}
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Precio actual</dt>
                    <dd class="mt-1 text-xl text-gray-900" v-if="precioEquipoActual">
                      <span class="text-green-600 font-semibold">$</span>
                      {{
                      loader.precioFormatter(precioEquipoActual) }}
                    </dd>
                    <dd class="mt-1 text-sm text-gray-900" v-else>Sin precio actual actualizado</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Meses de su adquisición</dt>
                    <dd class="mt-1 text-xl text-gray-900">{{ mesesDespuesAdqEq }} meses</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Precio de venta</dt>
                    <dd class="mt-1 text-xl text-gray-900" v-if="equipmentObject.precioActualVenta">
                      <span class="text-green-600 font-semibold">$</span>
                      {{
                      loader.precioFormatter(equipmentObject.precioActualVenta) }}
                    </dd>
                    <dd class="mt-1 text-xl text-gray-900" v-else>Sin precio de venta</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Mensualidades De Renta Total</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ noPagosRentasTotal }} mensualidades
                      asignadas
                    </dd>
                    <dd class="mt-1 text-xl text-gray-900" v-if="sumPagosRentasTotal">
                      <span class="text-gray-700 font-semibold">Total:</span>
                      <span class="text-green-600 font-semibold">$</span>
                      {{
                      loader.precioFormatter(sumPagosRentasTotal)
                      }}
                    </dd>
                    <dd class="mt-1 text-xl text-gray-900" v-else>Sin rentas asignadas</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Mensualidades De Renta Pagadas</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      {{ noPagosRentasPagados }} mensualidades
                      pagadas
                    </dd>
                    <dd class="mt-1 text-xl text-gray-900" v-if="sumPagosRentasPagados">
                      <span class="text-gray-700 font-semibold">Total:</span>
                      <span class="text-green-600 font-semibold">$</span>
                      {{
                      loader.precioFormatter(sumPagosRentasPagados)
                      }}
                    </dd>
                    <dd class="mt-1 text-xl text-gray-900" v-else>Sin mensualidades pagadas</dd>
                  </div>
                  <div class="sm:col-span-4 py-1 -mt-4">
                    <divisorComponent />
                  </div>
                  <div class="text-right -my-6 sm:col-span-4">
                    <div
                      class="flex justify-end items-center"
                      @click="switchMXNToUSD = !switchMXNToUSD"
                    >
                      <h2
                        :class="`text-xs ${switchMXNToUSD ? 'text-gray-400' : 'text-gray-600 font-semibold'}`"
                      >MXN</h2>
                      <div
                        class="w-12 h-5 flex items-center bg-gray-200 rounded-full p-1 duration-200 ease-in-out"
                        :class="{ 'bg-green-200': switchMXNToUSD }"
                      >
                        <div
                          class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out"
                          :class="{ 'translate-x-6': switchMXNToUSD, }"
                        ></div>
                      </div>
                      <h2
                        :class="`text-xs ${!switchMXNToUSD ? 'text-gray-400' : 'text-gray-600 font-semibold'}`"
                      >USD</h2>
                    </div>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Mensualidad óptima</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xl font-semibold text-green-600"
                      >
                        <span class="text-green-600 font-semibold">$</span>
                        {{
                        loader.precioFormatter(renta(1)) }}
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">Proyección de gastos mensuales</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2 py-1 text-xl font-semibold text-red-600"
                      >
                        <span class="text-red-600 font-semibold">$</span>
                        {{
                        loader.precioFormatter(sumGastosMensuales) }}
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-1"></div>
                  <div class="sm:col-span-1"></div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">
                      Acumulado de renta óptima
                      <p />
                      <span class="text-gray-500 font-light">
                        (En el mes {{ mesesDespuesAdqEq
                        }})
                      </span>
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xl font-semibold text-green-600"
                      >
                        <span class="text-green-600 font-semibold">$</span>
                        {{
                        loader.precioFormatter(renta(inputMes)) }}
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">
                      Acumulado de Utilidad óptima
                      <span
                        class="text-gray-500 font-light"
                      >(En el mes {{ mesesDespuesAdqEq }})</span>
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xl font-semibold text-green-600"
                      >
                        <span class="text-green-600 font-semibold">$</span>
                        {{
                        loader.precioFormatter(utilidad(inputMes)) }}
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">
                      Costo actual óptimo
                      <span
                        class="text-gray-500 font-light"
                      >(En el mes {{ mesesDespuesAdqEq }})</span>
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xl font-semibold text-green-600"
                      >
                        <span class="text-green-600 font-semibold">$</span>
                        {{
                        loader.precioFormatter(costo(inputMes)) }}
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-700">
                      Valor comercial
                      <span
                        class="text-gray-500 font-light"
                      >(En el mes {{ mesesDespuesAdqEq }})</span>
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xl font-semibold text-green-600"
                      >
                        <span class="text-green-600 font-semibold">$</span>
                        {{
                        loader.precioFormatter(conversiónMXNToUSD(precioVenta(inputMes))) }}
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-4">
                    <divisorComponent />
                  </div>
                  <div class="sm:col-span-4 mb-6">
                    <div class="transition rounded-lg mb-1 text-center bg-white mt-2">
                      <span
                        class="text-xl font-semibold text-gray-700 hover:cursor-pointer"
                        @click="isOpen = !isOpen"
                      >{{ (isOpen) ? 'Cerrar' : 'Mostrar' }} detalles de los gastos</span>
                      <div v-if="isOpen" class="p-4 bg-white">
                        <div class="hidden sm:block m-2">
                          <nav
                            class="isolate flex divide-x divide-gray-200 rounded-lg shadow"
                            aria-label="Tabs"
                          >
                            <a
                              v-for="(tab, tabIdx) in tabs"
                              :key="tab.name"
                              :class="[tab.current ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700', tabIdx === 0 ? 'rounded-l-lg' : '', tabIdx === tabs.length - 1 ? 'rounded-r-lg' : '', 'group relative min-w-0 flex-1 overflow-hidden ', tab.current ? 'bg-gray-50' : 'bg-white', 'py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 hover:cursor-pointer']"
                              :aria-current="tab.current ? 'page' : undefined"
                              @click="changeTab(tabIdx)"
                            >
                              <span>{{ tab.name }}</span>
                              <span
                                aria-hidden="true"
                                :class="[tab.current ? 'bg-green-500' : 'bg-transparent', 'absolute inset-x-0 bottom-0 h-0.5']"
                              ></span>
                            </a>
                          </nav>
                        </div>
                        <div
                          class="overflow-hidden rounded-lg border border-gray-200 shadow-md bg-white"
                        >
                          <div class="overflow-x-auto">
                            <TransitionGroup tag="div" name="list" mode="out-in">
                              <table
                                class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300"
                                v-if="tabs[0].current && tableFE.rowFixedExpenses.data.length > 0"
                              >
                                <thead class="bg-gray-50">
                                  <tr>
                                    <th
                                      scope="col"
                                      class="py-2 text-left text-sm font-semibold text-gray-900 sm:pl-3"
                                      v-for="(columnName, i) in tableFE.columnFixedExpenses"
                                      :key="i"
                                    >{{ columnName }}</th>
                                  </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 border-t bg-white">
                                  <tr
                                    class="hover:bg-gray-100"
                                    v-for="(rowFixedExpense, i) in tableFE.rowFixedExpenses.data"
                                    :key="i"
                                  >
                                    <th class="flex gap-1 px-3 py-2 font-normal text-gray-900">
                                      <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                          {{
                                          rowFixedExpense.type_fixed_expense.tipoGastoFijo
                                          }}
                                        </div>
                                      </div>
                                    </th>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                      <div class="text-gray-600">{{ rowFixedExpense.gastoFijo }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                      <div class="text-gray-600">
                                        {{
                                        loader.transformarFecha(rowFixedExpense.fechaGastoFijo)
                                        }}
                                      </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                      <div class="text-gray-600">
                                        <span class="font-medium text-green-600">$</span>
                                        {{
                                        loader.precioFormatter(rowFixedExpense.costoGastoFijo)
                                        }}
                                      </div>
                                    </td>
                                    <td
                                      class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 truncate"
                                    >
                                      <div
                                        class="text-gray-600"
                                        v-if="rowFixedExpense.folioFactura"
                                      >
                                        {{
                                        rowFixedExpense.folioFactura }}
                                      </div>
                                      <div class="text-red-500" v-else>Sin Folio</div>
                                    </td>
                                  </tr>
                                  <tr class="bg-gray-50">
                                    <td class="px-3 py-2 font-semibold text-gray-900">
                                      Total
                                      de Gastos Fijos:
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td
                                      class="whitespace-nowrap px-3 py-1 text-sm text-gray-500 font-semibold"
                                    >
                                      <span class="font-medium text-green-600">$</span>
                                      {{
                                      loader.precioFormatter(equipmentObject.sumGastosFijos)
                                      }}
                                    </td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                              <table
                                class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300"
                                v-else-if="tabs[1].current && tableVE.rowVariablesExpenses.data.length > 0"
                              >
                                <thead class="bg-gray-50">
                                  <tr>
                                    <th
                                      scope="col"
                                      class="py-2 text-left text-sm font-semibold text-gray-900 sm:pl-3"
                                      v-for="(columnName, i) in tableVE.columnVariablesExpenses"
                                      :key="i"
                                    >{{ columnName }}</th>
                                  </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 border-t bg-white">
                                  <tr
                                    class="hover:bg-gray-100"
                                    v-for="(rowVariableExpense, i) in tableVE.rowVariablesExpenses.data"
                                    :key="i"
                                  >
                                    <th class="flex gap-1 px-3 py-2 font-normal text-gray-900">
                                      <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                          {{
                                          rowVariableExpense.gastoVariable
                                          }}
                                        </div>
                                      </div>
                                    </th>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                      <div class="text-gray-600">
                                        {{
                                        loader.transformarFecha(rowVariableExpense.fechaGastoVariable)
                                        }}
                                      </div>
                                    </td>
                                    <td
                                      class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 truncate"
                                    >
                                      <div
                                        class="text-gray-600"
                                        v-if="rowVariableExpense.descripcion"
                                      >
                                        {{
                                        rowVariableExpense.descripcion }}
                                      </div>
                                      <div class="text-red-500" v-else>Sin Descripción</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                      <div class="text-gray-600">
                                        <span class="font-medium text-green-600">$</span>
                                        {{
                                        loader.precioFormatter(rowVariableExpense.costoGastoVariable)
                                        }}
                                      </div>
                                    </td>
                                  </tr>
                                  <tr class="bg-gray-50">
                                    <td class="px-3 py-2 font-semibold text-gray-900">
                                      Total
                                      de Gastos Variables:
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td
                                      class="whitespace-nowrap px-3 py-1 text-sm text-gray-500 font-semibold"
                                    >
                                      <span class="font-medium text-green-600">$</span>
                                      {{
                                      loader.precioFormatter(equipmentObject.sumGastosVariables)
                                      }}
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table
                                class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300"
                                v-else-if="tabs[2].current && tableME.rowMonthlyExpenses.data.length > 0"
                              >
                                <thead class="bg-gray-50">
                                  <tr>
                                    <th
                                      scope="col"
                                      class="py-2 text-left text-sm font-semibold text-gray-900 sm:pl-3"
                                      v-for="(columnName, i) in tableME.columnMonthlyExpenses"
                                      :key="i"
                                    >{{ columnName }}</th>
                                  </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 border-t bg-white">
                                  <tr
                                    class="hover:bg-gray-100"
                                    v-for="(rowMonthlyExpense, i) in tableME.rowMonthlyExpenses.data"
                                    :key="i"
                                  >
                                    <th class="flex gap-1 px-3 py-2 font-normal text-gray-900">
                                      <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                          {{
                                          rowMonthlyExpense.gastoMensual
                                          }}
                                        </div>
                                      </div>
                                    </th>
                                    <td
                                      class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 truncate"
                                    >
                                      <div
                                        class="text-gray-600"
                                        v-if="rowMonthlyExpense.descripcion"
                                      >
                                        {{
                                        rowMonthlyExpense.descripcion }}
                                      </div>
                                      <div class="text-red-500" v-else>Sin Descripción</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                      <div class="text-gray-600">
                                        {{
                                        rowMonthlyExpense.type_fixed_expense.tipoGastoFijo
                                        }}
                                      </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                      <div class="text-gray-600">
                                        <span class="font-medium text-green-600">$</span>
                                        {{
                                        loader.precioFormatter(rowMonthlyExpense.costoMensual)
                                        }}
                                      </div>
                                    </td>
                                  </tr>
                                  <tr class="bg-gray-50">
                                    <td class="px-3 py-2 font-semibold text-gray-900">
                                      Total
                                      de Gastos Mensuales:
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td
                                      class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 font-semibold"
                                    >
                                      <span class="font-medium text-green-600">$</span>
                                      {{
                                      loader.precioFormatter(equipmentObject.sumGastosMensuales)
                                      }}
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <div v-else class="text-center justify-center p-4">
                                <span class="text-lg font-medium text-gray-700">
                                  Sin
                                  Gastos {{ (tabs[0].current) ? 'Fijos' : '' ||
                                  (tabs[1].current) ? 'Variables' : '' ||
                                  (tabs[2].current) ? 'Mensuales' : '' }}
                                </span>
                              </div>
                            </TransitionGroup>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="sm:col-span-4 mb-4">
                    <dt class="text-sm font-medium text-gray-700">Attachments</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <ul
                        role="list"
                        class="divide-y divide-gray-200 rounded-md border border-gray-200"
                      >
                        <li
                          v-for="attachment in attachments"
                          :key="attachment.name"
                          class="flex items-center justify-between py-3 pl-3 pr-4 text-sm"
                        >
                          <div class="flex w-0 flex-1 items-center">
                            <PaperClipIcon
                              class="h-5 w-5 flex-shrink-0 text-gray-400"
                              aria-hidden="true"
                            />
                            <span class="ml-2 w-0 flex-1 truncate">{{ attachment.name }}</span>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                            <a
                              :href="attachment.href"
                              class="font-medium text-blue-600 hover:text-blue-500"
                            >Download</a>
                          </div>
                        </li>
                      </ul>
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </section>
          <!-- Referencia de las rentas -->
          <section aria-labelledby="notes-title">
            <div class="bg-white shadow sm:overflow-hidden sm:rounded-lg">
              <div class="divide-y divide-gray-200">
                <div class="px-4 py-5 sm:px-6">
                  <h2 id="notes-title" class="text-lg font-medium text-gray-900 text-center">
                    Rentas
                    Relacionadas al
                    equipo
                  </h2>
                </div>
                <div class="px-4 py-6 sm:px-6">
                  <ul role="list" class="space-y-8" v-if="equipmentObject.renta.length > 0">
                    <li v-for="(rent, i) in equipmentObject.renta" :key="rent.clvRenta">
                      <div class="flex space-x-3">
                        <div>
                          <div class="text-sm">
                            <a class="font-medium text-gray-900">Renta No.{{ i + 1 }}</a>
                            <div class="px-3 inline-flex">
                              <span
                                :class="`px-2 py-1 text-xs font-semibold inline-flex items-center gap-1 rounded-full ${rent.status_rent.bgColorPrimary} ${rent.status_rent.textColor}`"
                              >
                                <span
                                  :class="`h-1.5 w-1.5 rounded-full ${rent.status_rent.bgColorSecondary}`"
                                ></span>
                                {{ rent.status_rent.estadoRenta }}
                              </span>
                            </div>
                          </div>
                          <div class="mt-1 text-sm text-gray-700">
                            <p>
                              <span class="font-semibold text-base">
                                Información
                                Básica:
                              </span>
                              <span class="font-normal">
                                Esta renta empezó
                                el
                                <span
                                  class="font-semibold"
                                >
                                  {{
                                  loader.transformarFecha(rent.fecha_inicio) }}
                                </span> y
                                terminó
                                el
                                <span
                                  class="font-semibold"
                                >
                                  {{
                                  loader.transformarFecha(rent.fecha_fin) }}
                                </span>
                              </span>
                            </p>
                            <p>
                              Con
                              <span class="font-semibold">
                                {{ rent.payments_rents.length
                                }}
                              </span> mensualidades:
                              <span v-if="equipmentObject.paymentsByStatus.Pagado">
                                <span class="font-semibold">
                                  {{
                                  equipmentObject.paymentsByStatus.Pagado.payments.length
                                  }}
                                </span>
                                Ya están pagadas,
                              </span>
                              <span v-if="equipmentObject.paymentsByStatus['Pendiente de pago']">
                                {{
                                equipmentObject.paymentsByStatus['Pendiente de pago'].payments.length
                                }}
                                están pendientes,
                              </span>
                              <span v-if="equipmentObject.paymentsByStatus['En Mora']">
                                {{
                                equipmentObject.paymentsByStatus['En Mora'].payments.length
                                }}
                                faltan
                                por pagar
                              </span>
                            </p>
                            <p>
                              Cada mensualidad es de
                              <span class="text-green-600 font-semibold">$</span>
                              <span class="font-semibold">
                                {{
                                loader.precioFormatter(Number(rent.payments_rents[0].pagoRenta)
                                +
                                Number(rent.payments_rents[0].ivaRenta)) }}
                              </span>
                            </p>
                            <p class="font-semibold">
                              Total:
                              <span class="text-green-600">$</span>
                              {{
                              loader.precioFormatter((Number(rent.payments_rents[0].pagoRenta)
                              +
                              Number(rent.payments_rents[0].ivaRenta)) *
                              rent.payments_rents.length) }}
                            </p>
                            <p class="font-semibold" v-if="equipmentObject.paymentsByStatus.Pagado">
                              Abonado:
                              <span class="text-green-600">$</span>
                              {{
                              loader.precioFormatter((Number(rent.payments_rents[0].pagoRenta)
                              +
                              Number(rent.payments_rents[0].ivaRenta)) *
                              equipmentObject.paymentsByStatus.Pagado.payments.length)
                              }}
                            </p>
                            <p
                              class="font-semibold"
                              v-if="equipmentObject.paymentsByStatus.Pagado && ((Number(rent.payments_rents[0].pagoRenta)
                                                                        +
                                                                        Number(rent.payments_rents[0].ivaRenta)) *
                                                                        rent.payments_rents.length) != ((Number(rent.payments_rents[0].pagoRenta)
                                                                            +
                                                                            Number(rent.payments_rents[0].ivaRenta)) *
                                                                            equipmentObject.paymentsByStatus.Pagado.payments.length)"
                            >
                              Faltante:
                              <span class="text-green-600">$</span>
                              {{
                              loader.precioFormatter(((Number(rent.payments_rents[0].pagoRenta)
                              +
                              Number(rent.payments_rents[0].ivaRenta)) *
                              rent.payments_rents.length) -
                              ((Number(rent.payments_rents[0].pagoRenta)
                              +
                              Number(rent.payments_rents[0].ivaRenta)) *
                              equipmentObject.paymentsByStatus.Pagado.payments.length))
                              }}
                            </p>
                            <p v-else class="font-semibold">Falta pagar todo</p>
                            <p v-if="rent.descripcion">{{ rent.descripcion }}</p>
                            <p v-else class="text-red-600">Sin descripción</p>
                          </div>
                          <div class="mt-4 space-x-2 text-sm text-left">
                            <a
                              :href="`${rent.urlEdit}`"
                              target="_blank"
                              class="font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 p-2 rounded-lg"
                            >
                              Editar
                              Renta
                            </a>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <h3 class="text-xl text-gray-600 font-semibold text-center" v-else>Sin rentar aún</h3>
                </div>
              </div>
            </div>
          </section>
        </div>
        <!-- Información extra y herramientas básicas -->
        <section aria-labelledby="timeline-title" class="lg:col-span-1 lg:col-start-3">
          <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-1">
            <h2 id="timeline-title" class="text-lg font-medium text-gray-900 px-3">
              Información adicional y
              herramientas
            </h2>
            <div class="flow-root">
              <ul role="list" class="-mb-2">
                <dl class="grid grid-cols-1 gap-x-1 sm:grid-cols-2">
                  <li class="scale-75 hover:scale-90 duration-200 sm:col-span-1 -my-2">
                    <div class="relative bg-gray-50 py-6 px-6 rounded-2xl w-64 shadow-xl">
                      <div
                        class="text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-amber-500 left-4 -top-6"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-8 w-8"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"
                          />
                        </svg>
                      </div>
                      <div class="mt-10">
                        <p class="text-xl font-semibold my-2">Sumatoria de gastos fijos</p>
                        <div class="flex space-x-2 text-gray-400 text-sm py-2">
                          <span
                            class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2 py-1 text-3xl font-semibold text-amber-600"
                          >
                            <span class="text-amber-600 font-semibold">$</span>
                            {{
                            loader.precioFormatter(sumGastosFijos) }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="scale-75 hover:scale-90 duration-200 sm:col-span-1 -my-2">
                    <div class="relative bg-gray-50 py-6 px-6 rounded-2xl w-64 shadow-xl">
                      <div
                        class="text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-amber-500 left-4 -top-6"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-8 w-8"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"
                          />
                        </svg>
                      </div>
                      <div class="mt-10">
                        <p class="text-xl font-semibold my-2">Sumatoria de gastos variables</p>
                        <div class="flex space-x-2 text-gray-400 text-sm py-2">
                          <span
                            class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2 py-1 text-3xl font-semibold text-amber-600"
                          >
                            <span class="text-amber-600 font-semibold">$</span>
                            {{
                            loader.precioFormatter(sumGastosVariables) }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="scale-75 hover:scale-90 duration-200 sm:col-span-2 -my-4">
                    <div class="relative bg-gray-50 py-6 px-6 rounded-2xl w-65 shadow-xl">
                      <div
                        :class="`text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl ${(utilidadRealTotal > 0) ? 'bg-green-500' : 'bg-yellow-500'} left-4 -top-6`"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-8 w-8"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                          />
                        </svg>
                      </div>
                      <div class="mt-10">
                        <p class="text-xl font-semibold my-2">Utilidad Real respecto a rentas</p>
                        <div class="flex space-x-2 text-gray-400 text-sm py-2">
                          <span
                            :class="`inline-flex items-center gap-1 rounded-full ${(utilidadRealTotal > 0) ? 'bg-green-100' : 'bg-yellow-100'} px-2 py-1 text-3xl font-semibold ${(utilidadRealTotal > 0) ? 'text-green-600' : 'text-yellow-600'}`"
                          >
                            <span
                              :class="`${(utilidadRealTotal > 0) ? 'text-green-600' : 'text-yellow-600'} font-semibold`"
                            >$</span>
                            {{
                            loader.precioFormatter(utilidadRealTotal) }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="scale-75 hover:scale-90 duration-200 sm:col-span-1 -my-8">
                    <div class="relative bg-gray-50 py-6 px-6 rounded-2xl w-64 shadow-xl">
                      <div
                        class="text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-500 left-4 -top-6"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-8 w-8"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"
                          />
                        </svg>
                      </div>
                      <div class="mt-10">
                        <p class="text-xl font-semibold my-2">Calcular Mensualidad Optima y Utilidad</p>
                        <div class="flex space-x-2 text-gray-400 text-sm py-2">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-15 w-15"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"
                            />
                          </svg>
                          <p>
                            Ingresa el valor para ver los resultados de renta con respecto a un
                            porcentaje adicional de los gastos mensuales (Por defecto es {{
                            porGananciaRenta }}%):
                          </p>
                        </div>
                        <div class="border-t-2"></div>
                        <div class="flex justify-between">
                          <div class="my-2">
                            <label class="block text-sm font-medium text-gray-700">Porcentaje(%)</label>
                            <input
                              type="number"
                              pattern="[0-9]+(\.[0-9]+)?"
                              min="0"
                              max="100"
                              step="1"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                              placeholder="Ingresa porcentaje (%)"
                              v-model="inputPorcentaje"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="scale-75 hover:scale-90 duration-200 sm:col-span-1 -my-8">
                    <div class="relative bg-gray-50 py-6 px-6 rounded-2xl w-64 shadow-xl">
                      <div
                        class="text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-500 left-4 -top-6"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-8 w-8"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"
                          />
                        </svg>
                      </div>
                      <div class="mt-10">
                        <p class="text-xl font-semibold my-2">Calcular Valores en Mes Especifico</p>
                        <div class="flex space-x-2 text-gray-400 text-sm py-2">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-15 w-15"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"
                            />
                          </svg>
                          <p>
                            Ingresa el valor para ver los resultados en su respectivo mes (Por
                            defecto se trabaja con el més actual despues de adquirir el equipo):
                          </p>
                        </div>
                        <div class="border-t-2"></div>
                        <div class="flex justify-between">
                          <div class="my-2">
                            <label class="block text-sm font-medium text-gray-700">
                              Mes De
                              Venta Actual
                            </label>
                            <input
                              type="number"
                              pattern="[0-9]+(\.[0-9]+)?"
                              min="0"
                              max="48"
                              step="1"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                              placeholder="Ingresa mes"
                              v-model="inputMes"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </dl>
              </ul>
            </div>
          </div>
        </section>
        <!-- Detalles avanzados de proyecciones mensuales -->
        <section aria-labelledby="timeline-title" class="lg:col-span-3 lg:col-start-1">
          <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-1">
            <article class="Wrapper">
              <div class="Section px-3 text-center">
                <button
                  v-bind="toggleAttrs"
                  @click="handleCollapse"
                  :class="[
                                    'Panel',
                                    {
                                        Active: isExpanded,
                                    },
                                    'text-lg font-medium text-gray-900'
                                ]"
                >{{ isExpanded ? 'Ocultar' : 'Mostrar' }} Detalles Mensuales Avanzados</button>
                <Collapse v-bind="collapseAttrs" :when="isExpanded" class="v-collapse">
                  <p class="text-gray-600 text-base font-sans py-2">
                    Información detallada sobre el valor del equipo sobre
                    <span class="font-bold">
                      {{
                      mesesDepEq }}
                    </span> meses de
                    utilidad óptima
                  </p>
                  <!-- Tabla de Detalles -->
                  <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md bg-white">
                    <div class="overflow-x-auto">
                      <table
                        class="min-w-full border-collapse bg-white text-center text-sm text-gray-500 divide-y divide-gray-300"
                      >
                        <thead class="bg-gray-50">
                          <tr>
                            <th
                              scope="col"
                              class="py-2 text-sm font-semibold text-gray-900 sm:pl-3"
                              v-for="(columnName, i) in advanceDetaillColumnNames"
                              :key="i"
                            >{{ columnName }}</th>
                          </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 border-t bg-white">
                          <tr class="hover:bg-gray-100" v-for="i in mesesDepEq" :key="i">
                            <th class="whitespace-nowrap px-3 py-2 font-normal">
                              <div class="text-sm">
                                <div
                                  :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'text-gray-800 font-bold text-base' : (i === mesesDespuesAdqEq) ? 'text-green-700 font-bold text-lg' : 'text-gray-500 font-medium']"
                                >
                                  {{
                                  i
                                  }}
                                </div>
                              </div>
                            </th>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(GastoEnMes(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(valorComercial(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(valorReal(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(valorComercialDolarRT(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(renta(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(utilidad(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                {{ Math.round(valorComercialPorc(i) *
                                100) }}
                                <span
                                  class="text-green-600"
                                >%</span>
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(costo(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(precioVenta(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                <span class="text-green-600">$</span>
                                {{ loader.precioFormatter(ganancia(i)) }}
                              </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-2">
                              <div
                                :class="[(i % 12 === 0 && i !== mesesDespuesAdqEq) ? 'font-bold text-base text-gray-700' : (i === mesesDespuesAdqEq) ? 'font-bold text-lg text-green-800' : 'font-medium text-sm text-gray-500']"
                              >
                                {{ Math.round(costoPorc(i) * 100)
                                }}
                                <span
                                  class="text-green-600"
                                >%</span>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </Collapse>
              </div>
            </article>
          </div>
        </section>
      </div>
    </main>
  </div>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue';
import { Collapse } from 'vue-collapsed';
import {
    ArrowLongLeftIcon,
    PaperClipIcon,
} from '@heroicons/vue/20/solid';
import { equipments } from '@/js/store/Admin/Equipments.js';
import divisorComponent from '@/js/components/Common/divisor.vue';
//
const loader = equipments(), url = window.location.href, urlWithoutHash = url.split("#")[0],
    segments = urlWithoutHash.split("/"), lastSegment = Number(segments[segments.length - 1]);
//
const equipment = ref(), equipmentObject = ref(), mesesDespuesAdqEq = ref(), tableFE = ref(), tableVE = ref(),
    tableME = ref(), precioEquipo = ref(), precioEquipoActual = ref(), sumGastosFijos = ref(),
    sumGastosVariables = ref(), sumGastosMensuales = ref(), costoNetoAnual = ref(), porDeprAnual = ref(),
    dollarToRate = ref(), usdToMXNRealTime = ref(), sumPagosRentasTotal = ref(), noPagosRentasTotal = ref(),
    sumPagosRentasPagados = ref(), noPagosRentasPagados = ref();
const porGananciaRenta = ref(25), inputMes = ref(), inputPorcentaje = ref(),
    switchMXNToUSD = ref(false), isOpen = ref(false), isExpanded = ref(false);
//
const advanceDetaillColumnNames = [
    'Mes',
    'Gasto',
    'Valor Comercial',
    'Valor Real',
    'Dollar',
    'Renta',
    'Utilidad',
    'Valor Comercial(%)',
    'Costo',
    'Precio Venta',
    'Ganancia',
    'Costo(%)',
];
const tabs = ref([
    { name: 'Fijos', current: true },
    { name: 'Variables', current: false },
    { name: 'Mensuales', current: false },
]);
//
defineProps({
    logo: {
        type: String,
        required: false,
        default: 'https://tailwindui.com/img/logos/mark.svg?color=rose&shade=500',
    },
    image_tractor: {
        type: String,
        required: false,
        default: '',
    }
});
//
onMounted(async () => {
    try {
        equipment.value = await loader.show(lastSegment);
        dollarToRate.value = await loader.dollarRates();
    } catch (error) {
        console.error(error);
    }
    // console.log(equipment.value);
    equipmentObject.value = equipment.value.equipment;
    tableFE.value = equipment.value.tableFixedExpenses;
    tableVE.value = equipment.value.tableVariablesExpenses;
    tableME.value = equipment.value.tableMonthlyExpenses;
    mesesDespuesAdqEq.value = loader.mesesDespuesDeAdq(equipmentObject.value.fechaAdquisicion);
    usdToMXNRealTime.value = Number(dollarToRate.value.rates.MXN);
    precioEquipo.value = Number(equipmentObject.value.precioEquipo);
    precioEquipoActual.value = Number(equipmentObject.value.precioEquipoActual);
    sumGastosFijos.value = Number(equipmentObject.value.sumGastosFijos);
    sumGastosVariables.value = Number(equipmentObject.value.sumGastosVariables);
    sumGastosMensuales.value = Number(equipmentObject.value.sumGastosMensuales);
    costoNetoAnual.value = Number(equipmentObject.value.costoNetoAnual);
    porDeprAnual.value = Number(equipmentObject.value.porDeprAnual);
    sumPagosRentasTotal.value = Number(equipmentObject.value.sumPagosRentasTotal.sumPagosRentasTotal);
    noPagosRentasTotal.value = Number(equipmentObject.value.sumPagosRentasTotal.noResultados);
    sumPagosRentasPagados.value = Number(equipmentObject.value.sumPagosRentasPagados.sumPagosRentasPagados);
    noPagosRentasPagados.value = Number(equipmentObject.value.sumPagosRentasPagados.noResultados);
    //
    inputPorcentaje.value = Number(porGananciaRenta.value);
    inputMes.value = Number(mesesDespuesAdqEq.value);
    //
});
//
const gastoMensualADiario = computed(() => {
    return (sumGastosMensuales.value / 30);
});
const mesesDepEq = computed(() => {
    return (100 / porDeprAnual.value) * 12;
});
const inputPorcentajeConvert = computed(() => {
    return 1 + (inputPorcentaje.value / 100);
});
const valorRealAdqYGastFi = computed(() => {
    return precioEquipo.value + sumGastosFijos.value;
});
const valorRealActYGastFi = computed(() => {
    return precioEquipoActual.value + sumGastosFijos.value;
});
const valorRealAdqYGastFiMasPorc = computed(() => {
    return valorRealAdqYGastFi.value / 0.85;
});
const valorComAdqYGastFiMasPorc = computed(() => {
    return valorRealActYGastFi.value / 0.85;
});
const rentaOptima = computed(() => {
    return sumGastosMensuales.value * inputPorcentajeConvert.value;
});
const utilidadMensual = computed(() => {
    return rentaOptima.value - sumGastosMensuales.value;
});
const utilidadRealTotal = computed(() => {
    return sumPagosRentasPagados.value - (sumGastosFijos.value + sumGastosVariables.value);
});
//
const GastoEnMes = computed(() => {
    return (mes) => {
        if (mes > 0)
            return sumGastosMensuales.value * mes;
        else
            return 0;
    };
});
const valorComercial = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorComAdqYGastFiMasPorc.value - GastoEnMes.value(mes);
        else
            return 0;
    }
});
const valorReal = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorRealAdqYGastFiMasPorc.value - GastoEnMes.value(mes);
        else
            return 0;
    }
});
const valorComercialDolar = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorComercial.value(mes) / 20;
        else
            return 0;
    }
});
const valorComercialDolarRT = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorComercial.value(mes) / usdToMXNRealTime.value;
        else
            return 0;
    }
});
const renta = computed(() => {
    return (mes) => {
        if (mes > 0)
            return rentaOptima.value * mes;
        else
            return 0;
    }
});
const utilidad = computed(() => {
    return (mes) => {
        if (mes > 0)
            return renta.value(mes) - GastoEnMes.value(mes);
        else
            return 0;
    }
});
const valorComercialPorc = computed(() => {
    return (mes) => {
        if (mes > 0)
            if (mes < 24)
                return valorComercial.value(mes) / valorRealActYGastFi.value;
            else
                return (89 - mes) / 100;
        else
            return 0;
    }
});
const costo = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorRealActYGastFi.value - GastoEnMes.value(mes - 1);
        else
            return 0;
    }
});
const precioVenta = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorRealActYGastFi.value * valorComercialPorc.value(mes);
        else
            return 0;
    }
});
const ganancia = computed(() => {
    return (mes) => {
        if (mes > 0)
            return precioVenta.value(mes) - costo.value(mes);
        else
            return 0;
    }
});
const costoPorc = computed(() => {
    return (mes) => {
        if (mes > 0)
            return ganancia.value(mes) / costo.value(mes);
        else
            return 0;
    }
});
const conversiónMXNToUSD = computed(() => {
    return (valor) => {
        if (valor > 0) {
            if (switchMXNToUSD.value)
                return valor / usdToMXNRealTime.value;
            else
                return valor;
        }
        else
            return 0;
    }
});
//
const breadcrumbs = [
    { name: 'Vista Detalles del Equipo', href: '#', current: true },
];
const attachments = [
    { name: 'resume_front_end_developer.pdf', href: '#' },
    { name: 'coverletter_front_end_developer.pdf', href: '#' },
];
//
const changeTab = (index) => {
    tabs.value.forEach((tab, idx) => {
        tab.current = idx === index;
    });
};
function handleCollapse() {
    isExpanded.value = !isExpanded.value
}
const toggleAttrs = computed(() => ({
    id: 'toggle',
    'aria-expanded': isExpanded.value,
    'aria-controls': 'collapse',
}))
const collapseAttrs = {
    'aria-labelledby': 'toggle',
    id: 'collapse',
    role: 'region',
}
</script>

<style scoped>
.list-enter-active,
.list-leave-active {
    transition: all 0.25s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

.v-collapse {
    transition: height var(--vc-auto-duration) ease-out;
}
</style>