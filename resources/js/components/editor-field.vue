<template>
    <FieldWrapper>
        <div class="mt-4 md:mt-0 pb-5 px-6 md:px-8 w-full">
            <div class="bg-white" :class="{ 'fixed-container': fixed }">
                


                <Tabs  :options="{ useUrlFragment: false }">
                    <Tab name="SAPC" tab="tab1">
                        <div v-if="field.showSelects" class="flex mb-3 bg-white">
                            <div class="w-1/6 px-1">
                                <strong class="block">Exercício</strong>
                                <v-select
                                    v-model="exercicioContaGovernoSelecionada"
                                    :filterable="false"
                                    inputId="value"
                                    label="label"
                                    :options="listaExercicio"
                                ></v-select>
                            </div>
                
                            <div class="w-1/6 px-1">
                                <strong class="block">Gerais</strong>
                                <v-select
                                    v-model="analiseSelecionada"
                                    :filterable="false"
                                    inputId="id"
                                    label="text"
                                    :options="listaAnalises"
                                ></v-select>
                                <button
                                    @click="addAnalise()"
                                    class="mt-2 w-full shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900"
                                    type="button"
                                >
                                    Adicionar Análise
                                </button>
                            </div>

                            <div class="w-1/6 px-1 bg-white">
                            
                                <strong class="block">Variável de Conta de Governo</strong>
                                <v-select
                                    v-model="variavelContaGovernoSelecionada"
                                    :filterable="false"
                                    inputId="id"
                                    label="nome"
                                    :options="listaVariaveisContaGoverno"
                                    @search="fetchVariaveisContaGoverno"
                                ></v-select>
                                <button
                                    @click="addVariavelContaGoverno()"
                                    class="mt-2 w-full shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900"
                                    type="button"
                                >
                                    Adicionar Conta de Governo
                                </button>
                            </div>                    
                            <div class="w-1/6 px-1 bg-white">
                                <strong class="block">Variável de Conta de Gestão</strong>
                                <v-select
                                    v-model="variavelContaGestaoSelecionada"
                                    :filterable="false"
                                    inputId="id"
                                    label="nome"
                                    :options="listaVariaveisContaGestao"
                                    @search="fetchVariaveisContaGestao"
                                ></v-select>
                                <button
                                    @click="addVariavelContaGestao()"
                                    class="mt-2 w-full shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900"
                                    type="button"
                                >
                                    Adicionar Conta de Gestão
                                </button>
                            </div>
                            <div class="w-1/6 px-1">
                                <strong class="block">Fórmulas</strong>
                                <v-select
                                    v-model="formulaSelecionada"
                                    :filterable="false"
                                    inputId="id"
                                    label="nome"
                                    :options="listaFormulas"
                                    @search="fetchFormulas"
                                ></v-select>
                                <button
                                    @click="addFormula()"
                                    class="mt-2 w-full shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900"
                                    type="button"
                                >
                                    Adicionar Fórmula
                                </button>
                            </div>
                        </div>

                    </Tab>


                    <Tab name="Planejamento" tab="tab4">
                        <div v-if="field.showSelects" class="">

                            <div class="w-1/6 px-1">
                                <strong class="block">Leis Orçamentárias</strong>
                                <v-select
                                    v-model="leiOrcamentariaSelecionada"
                                    :filterable="false"
                                    inputId="id"
                                    label="text"
                                    :options="listaLeisOrcamentarias"
                                ></v-select>
                                <button
                                    @click="addLeiOrcamentaria()"
                                    class="mt-2 w-full shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900"
                                    type="button"
                                >
                                    Adicionar Variável
                                </button>
                            </div>
                        </div>
                    </Tab>

                    <Tab name="RREO" tab="tab2">
                        <div v-if="field.showSelects" class="">
                            <div class="w-full px-1 flex">
                                <div class="w-1/3 px-1">
                                    <strong class="block">Período</strong>
                                    <v-select
                                        v-model="variavelRREOPeriodoSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="text"
                                        :options="listaRREOPeriodo"
                                    ></v-select>
                                </div>

                                <div class="w-1/3 px-1">
                                    <strong class="block">Anexo</strong>
                                    <v-select
                                        v-model="variavelRREOAnexoSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="anexo"
                                        :options="listaRREOAnexo"
                                        @search="fetchRREOAnexo"
                                        @update:modelValue="fetchRREOContaVazio"
                                    ></v-select>
                                </div>
                                <div class="w-1/3 px-1">
                                    <strong class="block">Conta</strong>
                                    <v-select
                                        v-model="variavelRREOContaSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="cod_conta"
                                        :disabled="!variavelRREOAnexoSelecionada"
                                        :options="listaRREOConta"
                                        @search="fetchRREOConta"
                                        @update:modelValue="fetchRREOColunaVazio"
                                    ></v-select>
                                </div>
                                <div class="w-1/3 px-1">
                                    <strong class="block">Coluna</strong>
                                    <v-select
                                        v-model="variavelRREOColunaSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="coluna"
                                        :disabled="!variavelRREOAnexoSelecionada || !variavelRREOContaSelecionada"
                                        :options="listaRREOColuna"
                                        @search="fetchRREOColuna"
                                    ></v-select>
                                </div>
                            </div> 

                            <div class="w-full px-1">
                                <button
                                    @click="addRREO()"
                                    class="mt-2 w-full shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900"
                                    type="button"
                                >
                                    Adicionar Variável RREO
                                </button>
                            </div>
                        </div>
                    </Tab>
                    <Tab name="RGF" tab="tab3">
                        <div v-if="field.showSelects" class="">
                            <div class="w-full px-1 flex">
                                <div class="w-1/3 px-1">
                                    <strong class="block">Poder</strong>
                                    <v-select
                                        v-model="variavelRGFPoderSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="text"
                                        :options="listaRGFPoder"
                                    ></v-select>
                                </div>
                                
                                <div class="w-1/3 px-1">
                                    <strong class="block">Período</strong>
                                    <v-select
                                        v-model="variavelRGFPeriodoSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="text"
                                        :options="listaRGFPeriodo"
                                    ></v-select>
                                </div>

                                <div class="w-1/3 px-1">
                                    <strong class="block">Anexo</strong>
                                    <v-select
                                        v-model="variavelRGFAnexoSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="anexo"
                                        :options="listaRGFAnexo"
                                        @search="fetchRGFAnexo"
                                        @update:modelValue="fetchRGFContaVazio()"
                                    ></v-select>
                                </div>
                                <div class="w-1/3 px-1">
                                    <strong class="block">Conta</strong>
                                    <v-select
                                        v-model="variavelRGFContaSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="cod_conta"
                                        :disabled="!variavelRGFAnexoSelecionada"
                                        :options="listaRGFConta"
                                        @search="fetchRGFConta"
                                        @update:modelValue="fetchRGFColunaVazio()"
                                    ></v-select>
                                </div>

                                <div class="w-1/3 px-1">
                                    <strong class="block">Coluna</strong>
                                    <v-select
                                        v-model="variavelRGFColunaSelecionada"
                                        :filterable="false"
                                        inputId="id"
                                        label="coluna"
                                        :disabled="!variavelRGFAnexoSelecionada || !variavelRGFContaSelecionada"
                                        :options="listaRGFColuna"
                                        @search="fetchRGFColuna"
                                    ></v-select>
                                </div>
                            </div>    
                            <div class="w-full px-1">
                                <button
                                    @click="addRGF()"
                                    class="mt-2 w-full shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900"
                                    type="button"
                                >
                                    Adicionar Variável RGF
                                </button>
                            </div> 
                        </div>
                    </Tab>
                </Tabs>
                
                
            </div>

            <textarea
                ref="editor"
                class="hidden"
                :id="currentField.attribute"
                :class="errorClasses"
                :value="value"
            />

            <p
                v-if="currentField.helpText"
                v-html="currentField.helpText"
                class="help-text help-text mt-2"
            />

            <media-browser
                @select="$options[editorName].execute('imageBrowser', $event)"
                type="image"
                :field-key="$options[editorUUID] + '-image'"
                :multiple="true"
                :has-larupload-trait="currentField.imageHasLaruploadTrait"
            />

            <media-browser
                @select="$options[editorName].execute('videoBrowser', $event)"
                type="video"
                :field-key="$options[editorUUID] + '-video'"
                :multiple="true"
                :has-larupload-trait="currentField.videoHasLaruploadTrait"
                :nova-video-is-legacy="currentField.novaVideoIsLegacy"
            />

            <media-browser
                @select="$options[editorName].execute('audioBrowser', $event)"
                type="audio"
                :field-key="$options[editorUUID] + '-audio'"
                :multiple="true"
            />

            <snippet-browser
                :field-key="$options[editorUUID]"
                :snippets="currentField.snippetBrowser"
            />
        </div>
    </FieldWrapper>
</template>

<script>
import CkEditor from "../ckeditor/ckeditor";
import SnippetBrowser from "./snippet-browser";
import MediaBrowser from "./media-browser";
import HasUUID from "./mixins/hasUUID";
import { DependentFormField, HandlesValidationErrors } from "laravel-nova";
import debounce from "lodash/debounce";
import RegexParser from "regex-parser";
import vSelect from "vue-select";
import {Tabs, Tab} from 'vue3-tabs-component';

export default {
    mixins: [DependentFormField, HandlesValidationErrors, HasUUID],
    props: ["resourceName", "resourceId", "field", "toolbar", "formUniqueId"],
    components: { SnippetBrowser, MediaBrowser, vSelect, Tabs, Tab },
    data() {
        return {
            mounted: false,
            fixed: false,
            listaVariaveisContaGestao: [],
            listaVariaveisContaGoverno: [],
            listaExercicio: [],
            listaFormulas: [],
            listaRREOPeriodo: [
                { text: "Período 1", value: "1" },
                { text: "Período 2", value: "2" },
                { text: "Período 3", value: "3" },
                { text: "Período 4", value: "4" },
                { text: "Período 5", value: "5" },
                { text: "Período 6", value: "6" },
            ],
            listaRREOAnexo: [],
            listaRREOConta: [],
            listaRREOColuna: [],
            listaRGFPeriodo: [
                { text: "Período 1 (Q1/S1)", value: "1" },
                { text: "Período 2 (Q2/S1)", value: "2" },
                { text: "Período 3 (Q3/S2)", value: "3" },
            ],
            listaRGFPoder: [
                { text: "Executivo", value: "E" },
                { text: "Legislativo", value: "L" },
            ],
            listaRGFAnexo: [],
            listaRGFConta: [],
            listaRGFColuna: [],
            listaAnalises: [
                { text: "Modelo Análise", value: "{Modelo Análise}" },
                { text: "Município", value: "{Município}" },
                { text: "Unidade Gestora", value: "{Unidade Gestora}" },
                { text: "Exercício da Análise", value: "_Atual{Exercício}" },
                { text: "1 Exercício Anterior", value: "_Atual-1{Exercício}" },
                { text: "2 Exercícios Anteriores", value: "_Atual-2{Exercício}" },
                { text: "3 Exercícios Anteriores", value: "_Atual-3{Exercício}" },
                { text: "Data de criação", value: "{Data de criação}" },
                { text: "Data de conclusão", value: "{Data de conclusão}" },
                { text: "Assinatura", value: "{Assinatura}" },
                { text: "Status", value: "{Status}" },
                { text: "Diretoria", value: "{Diretoria}" },
                { text: "Gestor", value: "{Gestor}" },
                { text: "Protocolo eTCE", value: "{Protocolo eTCE}" },
                { text: "Controlador", value: "{Controlador}" },
                { text: "Responsáveis Técnicos", value: "{Responsáveis Técnicos}" }
            ],
            listaLeisOrcamentarias: [
                { text: "NumeroPPA", value: "{NumeroPPA}" },
                { text: "DataPublicacaoPPA", value: "{DataPublicacaoPPA}" },
                { text: "VeiculoPublicacaoPPA", value: "{VeiculoPublicacaoPPA}" },
                { text: "NumeroLDO", value: "{NumeroLDO}" },
                { text: "DataPublicacaoLDO", value: "{DataPublicacaoLDO}" },
                { text: "VeiculoPublicacaoLDO", value: "{VeiculoPublicacaoLDO}" },
                { text: "NumeroLOA", value: "{NumeroLOA}" },
                { text: "DataPublicacaoLOA", value: "{DataPublicacaoLOA}" },
                { text: "VeiculoPublicacaoLOA", value: "{VeiculoPublicacaoLOA}" },
                { text: "NumeroAtoDetalhamentoDespesa", value: "{NumeroAtoDetalhamentoDespesa}" },
                { text: "DataPublicacaoDetalhamentoDespesa", value: "{DataPublicacaoDetalhamentoDespesa}" },
                { text: "VeiculoPublicacaoDetalhamentoDespesa", value: "{VeiculoPublicacaoDetalhamentoDespesa}" },
                { text: "ArtigoLoaSuplementacao", value: "{ArtigoLoaSuplementacao}" },
                { text: "LimiteSuplementacao", value: "{LimiteSuplementacao}" },
                { text: "LimiteOperacoesCredito", value: "{LimiteOperacoesCredito}" },
                { text: "LimiteMinimoEducacao", value: "{LimiteMinimoEducacao}" },
                { text: "LimiteMaximoPessoal", value: "{LimiteMaximoPessoal}" },
                { text: "ValorReceitaPrevista", value: "{ValorReceitaPrevista}" },
                { text: "ValorDespesaFixada", value: "{ValorDespesaFixada}" }
 
            ],
            variavelContaGestaoSelecionada: null,
            variavelContaGovernoSelecionada: null,
            exercicioContaGovernoSelecionada: {
                label: 'Exercício da Análise',
                value: 'Atual'
            },
            formulaSelecionada: null,
            variavelRREOPeriodoSelecionada: null,
            variavelRREOAnexoSelecionada: null,
            variavelRREOContaSelecionada: null,
            variavelRREOColunaSelecionada: null,
            variavelRGFPeriodoSelecionada: null,
            variavelRGFPoderSelecionada: null,
            variavelRGFAnexoSelecionada: null,
            variavelRGFContaSelecionada: null,
            variavelRGFColunaSelecionada: null,
            analiseSelecionada: null,
            leiOrcamentariaSelecionada: null,

            fieldName: { type: String },
            showErrors: { type: Boolean, default: true },
            fullWidthContent: { type: Boolean, default: false },
            labelFor: { default: null },
        };
    },
    computed: {
        editorName() {
            const attribute = this.currentField.attribute
                .toLowerCase()
                .replace(/[^a-zA-Z0-9]+(.)/g, (m, chr) => chr.toUpperCase());

            return attribute + "Editor" + this.formUniqueId;
        },
        fieldLabel() {
            // If the field name is purposefully an empty string, then let's show it as such
            if (this.fieldName === "") {
                return "";
            }

            return (
                this.fieldName || this.field.name || this.field.singularLabel
            );
        },

        /**
         * Determine help text should be shown.
         */
        shouldShowHelpText() {
            return this.showHelpText && this.field.helpText?.length > 0;
        },
    },
    watch: {
        value(value) {
            this.emitFieldValueChange(this.currentField.attribute, value || "");
        },

        currentlyIsVisible(status) {
            if (status && this.mounted) {
                setTimeout(this.createCkEditor, 5);
            }
        },
    },
    methods: {
        createCkEditor() {
            const toolbarOptions = this.initToolbarOptions(
                this.currentField.toolbarOptions
            );
            const headings = toolbarOptions.headings;
            const image = toolbarOptions.image ?? CkEditor.defaultConfig.image;

            delete toolbarOptions.headings;
            delete toolbarOptions.image;

            const config = {
                attribute: this.$options[this.editorUUID],
                imageBrowser: this.currentField.imageBrowser,
                videoBrowser: this.currentField.videoBrowser,
                audioBrowser: this.currentField.audioBrowser,
                snippetBrowser: this.currentField.snippetBrowser,
                htmlSupport: this.normalizeHtmlSupportItems(
                    this.currentField.htmlSupport
                ),
                isReadOnly: this.currentField.readonly,
                image: image,
                language: {
                    ui: this.currentField.uiLanguage,
                    content: this.currentField.contentLanguage,
                    textPartLanguage: this.currentField.textPartLanguage,
                },
                heading: {
                    options: headings,
                },
                toolbar: {
                    items: this.currentField.toolbar,
                    shouldNotGroupWhenFull:
                        this.currentField.shouldNotGroupWhenFull,
                    viewportTopOffset: 15,
                },
                simpleUpload: {
                    ...CkEditor.defaultConfig.simpleUpload,

                    headers: {
                        ...CkEditor.defaultConfig.simpleUpload.headers,
                        "X-Toolbar": this.currentField.toolbarName,
                    },
                },
                ...toolbarOptions,
            };

            CkEditor.create(this.$refs.editor, config)
                .then((editor) => {
                    const { editing, model } = (this.$options[this.editorName] =
                        editor);

                    // prevent question-mark & slash from triggering nova search
                    editing.view.document.on(
                        "keydown",
                        this.handleEditorEvents,
                        {
                            priority: "highest",
                        }
                    );

                    // sync model changes to vue-model
                    model.document.on(
                        "change",
                        debounce(this.handleEditorSync, 100),
                        {
                            priority: "lowest",
                        }
                    );

                    editor.editing.view.change((writer) => {
                        // set the height of the editor when editing
                        if (this.currentField.height > 1) {
                            writer.setStyle(
                                "height",
                                `${this.currentField.height}px`,
                                editor.editing.view.document.getRoot()
                            );
                        }

                        this.editorResizeFix(editor, writer);
                    });

                    if (this.currentField.readonly) {
                        editor.enableReadOnlyMode(
                            this.$options[this.editorUUID]
                        );
                    }
                })
                .catch((e) => {
                    console.log(e);
                    Nova.error(e.toString());
                });
        },

        destroyCkEditor() {
            if (this.$options[this.editorName]) {
                this.$options[this.editorName]
                    .destroy()
                    .then(() => (this.$options[this.editorName] = null))
                    .catch((e) => Nova.error(e.toString()));
            }
        },

        setInitialValue() {
            this.value = this.currentField.value || "";
        },

        initToolbarOptions(toolbarOptions) {
            if (toolbarOptions.mediaEmbed) {
                if (toolbarOptions.mediaEmbed.providers) {
                    toolbarOptions.mediaEmbed.providers =
                        this.normalizeMediaEmbedToolbarOptions(
                            toolbarOptions.mediaEmbed.providers
                        );
                }
                if (toolbarOptions.mediaEmbed.extraProviders) {
                    toolbarOptions.mediaEmbed.extraProviders =
                        this.normalizeMediaEmbedToolbarOptions(
                            toolbarOptions.mediaEmbed.extraProviders
                        );
                }
            }

            return toolbarOptions;
        },

        normalizeMediaEmbedToolbarOptions(providers) {
            if (providers && Array.isArray(providers)) {
                for (let i = 0; i < providers.length; i++) {
                    const url = providers[i]?.url ?? null;
                    const html = providers[i]?.html ?? null;

                    if (Array.isArray(url)) {
                        const urls = url;

                        for (let j = 0; j < urls.length; j++) {
                            urls[j] = RegexParser(urls[j]);
                        }

                        providers[i].url = urls;
                    } else if (url) {
                        providers[i].url = RegexParser(url);
                    }

                    if (html) {
                        providers[i].html = (match) => eval("`" + html + "`");
                    }
                }
            }

            return providers;
        },

        normalizeHtmlSupportItems(htmlSupport) {
            if (htmlSupport) {
                if (htmlSupport.allow) {
                    htmlSupport.allow.map((item) => {
                        if (item.name) {
                            item.name = this.stringToRegex(item.name);
                        }

                        return item;
                    });
                } else {
                    htmlSupport.allow = [];
                }

                if (htmlSupport.disallow) {
                    htmlSupport.disallow.map((item) => {
                        if (item.name) {
                            item.name = this.stringToRegex(item.name);
                        }

                        return item;
                    });
                } else {
                    htmlSupport.disallow = [];
                }

                return htmlSupport;
            }

            return {
                allow: [],
                disallow: [],
            };
        },

        stringToRegex(string) {
            if (
                typeof string === "string" &&
                string.startsWith("/") &&
                string.endsWith("/")
            ) {
                const regexPattern = string.slice(1, -1);

                return new RegExp(regexPattern);
            }

            return string;
        },

        fill(formData) {
            if (this.currentlyIsVisible) {
                formData.append(this.currentField.attribute, this.value || "");
            }
        },

        handleChange(value) {
            this.value = value;
        },

        handleEditorEvents(event, data) {
            if (
                ["Tab", "/"].includes(data.key) ||
                [191, 9].includes(data.keyCode)
            ) {
                data.stopPropagation();
            }
        },

        handleEditorSync() {
            const editor = this.$options[this.editorName];

            if (editor) {
                this.handleChange(editor.getData());
            }
        },

        // fix for keeping editor height on resize
        editorResizeFix(editor, writer) {
            const resizeObserver = new ResizeObserver(
                debounce((element) => {
                    const height = element[0].target.offsetHeight;

                    if (height > 10) {
                        writer.setStyle(
                            "height",
                            `${height}px`,
                            editor.editing.view.document.getRoot()
                        );
                    }
                }, 100)
            );

            const innerEditor = editor.ui.view.element.getElementsByClassName(
                "ck-editor__editable"
            );

            if (innerEditor?.length) {
                resizeObserver.observe(innerEditor[0]);
            }
        },

        addVariavelContaGestao() {
            const editor = this.$options[this.editorName];
            if (editor) {
                editor.model.change((writer) => {
                    const insertPosition =
                        editor.model.document.selection.getFirstPosition();

                    const viewFragment = editor.data.processor.toView(
                        "$_ge{" + this.variavelContaGestaoSelecionada.nome + "}"
                    );
                    const modelFragment = editor.data.toModel(viewFragment);
                    editor.model.insertContent(modelFragment, insertPosition);
                });
            }
        },

        addVariavelContaGoverno() {
            const editor = this.$options[this.editorName];
            if (editor) {
                editor.model.change((writer) => {
                    const insertPosition =
                        editor.model.document.selection.getFirstPosition();

                    const viewFragment = editor.data.processor.toView(
                        "$_go_"+
                            this.exercicioContaGovernoSelecionada.value +"_{" +
                            this.variavelContaGovernoSelecionada.nome +
                            "}"
                    );
                    const modelFragment = editor.data.toModel(viewFragment);
                    editor.model.insertContent(modelFragment, insertPosition);
                });
            }
        },

        addFormula() {
            const editor = this.$options[this.editorName];
            if (editor) {
                editor.model.change((writer) => {
                    const insertPosition =
                        editor.model.document.selection.getFirstPosition();

                    const viewFragment = editor.data.processor.toView(
                        "==#(" + this.formulaSelecionada.formula + ")#"
                    );
                    const modelFragment = editor.data.toModel(viewFragment);
                    editor.model.insertContent(modelFragment, insertPosition);
                });
            }
        },

        addRREO() {
            const editor = this.$options[this.editorName];
            if (editor) {
                editor.model.change((writer) => {
                    const insertPosition =
                        editor.model.document.selection.getFirstPosition();

                    const viewFragment = editor.data.processor.toView(
                        `$_rreo{`+`${this.variavelRREOPeriodoSelecionada.value}_`+`${this.variavelRREOAnexoSelecionada.anexo}_`+`${this.variavelRREOContaSelecionada.cod_conta}_`+`${this.variavelRREOColunaSelecionada.coluna}}`
                    );
                    const modelFragment = editor.data.toModel(viewFragment);
                    editor.model.insertContent(modelFragment, insertPosition);
                });
            }
        },

        addRGF() {
            const editor = this.$options[this.editorName];
            if (editor) {
                editor.model.change((writer) => {
                    const insertPosition =
                        editor.model.document.selection.getFirstPosition();
                         console.log(this.variavelRGFPoderSelecionada);
                    const viewFragment = editor.data.processor.toView(
                        `$_rgf{`+`${this.variavelRGFPoderSelecionada.value}_`+`${this.variavelRGFPeriodoSelecionada.value}_`+`${this.variavelRGFAnexoSelecionada.anexo}_`+`${this.variavelRGFContaSelecionada.cod_conta}_`+`${this.variavelRGFColunaSelecionada.coluna}}`
                    );
                    const modelFragment = editor.data.toModel(viewFragment);
                    editor.model.insertContent(modelFragment, insertPosition);
                });
            }
        },

        addAnalise() {
            const editor = this.$options[this.editorName];
            if (editor) {
                editor.model.change((writer) => {
                    const insertPosition =
                        editor.model.document.selection.getFirstPosition();

                    const viewFragment = editor.data.processor.toView(
                        `$_al${this.analiseSelecionada.value}`
                    );
                    const modelFragment = editor.data.toModel(viewFragment);
                    editor.model.insertContent(modelFragment, insertPosition);
                });
            }
        },

        addLeiOrcamentaria() {
            const editor = this.$options[this.editorName];
            if (editor) {
                editor.model.change((writer) => {
                    const insertPosition =
                        editor.model.document.selection.getFirstPosition();

                    const viewFragment = editor.data.processor.toView(
                        `$_lo${this.leiOrcamentariaSelecionada.value}`
                    );
                    const modelFragment = editor.data.toModel(viewFragment);
                    editor.model.insertContent(modelFragment, insertPosition);
                });
            }
        },

        /**
         * Triggered when the search text changes.
         *
         * @param search  {String}    Current search text
         * @param loading {Function}	Toggle loading class
         */
        async fetchVariaveisContaGestao(search, loading) {
            loading(true);

            if (search != "") {
                this.variavelContaGestaoSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/variaveis/${escape(search)}`
                    )
                    .then((res) => {
                        this.listaVariaveisContaGestao = res.data;
                    })
                    .catch();
            }

            loading(false);
        },

        async fetchVariaveisContaGoverno(search, loading) {
            loading(true);

            if (search != "") {
                this.variavelContaGovernoSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/variaveisContaGoverno/${escape(
                            search
                        )}`
                    )
                    .then((res) => {
                        this.listaVariaveisContaGoverno = res.data;
                    })
                    .catch();
            }

            loading(false);
        },

        async fetchRREOAnexo(search, loading) {
            loading(true);
            if (search != "") {
                this.variavelRREOAnexoSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/certidoes/rreo-anexos/${encodeURIComponent(this.variavelRREOPeriodoSelecionada.value)}/${encodeURIComponent(
                            search
                        )}`
                    )
                    .then((res) => {
                        this.listaRREOAnexo = res.data;
                    })
                    .catch();
            }

            loading(false);
        },

        async fetchRGFAnexo(search, loading) {
            loading(true);
            if (search != "") {
                this.variavelRGFAnexoSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/certidoes/rgf-anexos/${encodeURIComponent(this.variavelRGFPoderSelecionada.value)}/${encodeURIComponent(this.variavelRGFPeriodoSelecionada.value)}/${encodeURIComponent(
                            search
                        )}`
                    )
                    .then((res) => {
                        this.listaRGFAnexo = res.data;
                    })
                    .catch();
            }

            loading(false);
        },

        async fetchRREOConta(search, loading) {
            loading(true);

            console.log(encodeURIComponent(this.variavelRREOAnexoSelecionada.anexo));
            //if (search != "") {
                this.variavelRREOContaSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/certidoes/rreo-contas/anexo/${encodeURIComponent(this.variavelRREOPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRREOAnexoSelecionada.anexo)}/${encodeURIComponent(
                            search
                        )}`
                    )
                    .then((res) => {
                        
                        this.listaRREOConta= res.data;
                    })
                    .catch();
            //}

            loading(false);
        },

        async fetchRREOContaVazio() {
            //if (search != "") {

            console.log("conta vazia");
                this.variavelRREOContaSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/certidoes/rreo-contas/anexo/${encodeURIComponent(this.variavelRREOPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRREOAnexoSelecionada.anexo)}`
                    )
                    .then((res) => {
                        
                        this.listaRREOConta= res.data;
                    })
                    .catch();
            //}

        },

        async fetchRGFConta(search, loading) {
            loading(true);

            //if (search != "") {
                this.variavelRGFContaSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/certidoes/rgf-contas/anexo/${encodeURIComponent(this.variavelRGFPoderSelecionada.value)}/${encodeURIComponent(this.variavelRGFPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRGFAnexoSelecionada.anexo)}/${encodeURIComponent(
                            search
                        )}`
                    )
                    .then((res) => {
                        this.listaRGFConta= res.data;
                    })
                    .catch();
            //}

            loading(false);
        },

        async fetchRGFContaVazio() {
            this.variavelRGFContaSelecionada = null;
            await Nova.request()
                .get(
                    `/nova-vendor/nova-ckeditor/certidoes/rgf-contas/anexo/${encodeURIComponent(this.variavelRGFPoderSelecionada.value)}/${encodeURIComponent(this.variavelRGFPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRGFAnexoSelecionada.anexo)}`
                )
                .then((res) => {
                    this.listaRGFConta= res.data;
                })
                .catch();
        },

        async fetchRREOColuna(search, loading) {
            loading(true);

            if (search != "") {
                this.variavelRREOColunaSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/certidoes/rreo-colunas/anexo/${encodeURIComponent(this.variavelRREOPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRREOAnexoSelecionada.anexo)}/conta/${encodeURIComponent(this.variavelRREOContaSelecionada.cod_conta)}/${encodeURIComponent(search)}`
                    )
                    .then((res) => {
                        this.listaRREOColuna= res.data;
                    })
                    .catch();
            }

            loading(false);
        },

        async fetchRREOColunaVazio() {
            console.log("coluna vazia");
            this.variavelRREOColunaSelecionada = null;
            await Nova.request()
                .get(
                    `/nova-vendor/nova-ckeditor/certidoes/rreo-colunas/anexo/${encodeURIComponent(this.variavelRREOPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRREOAnexoSelecionada.anexo)}/conta/${encodeURIComponent(this.variavelRREOContaSelecionada.cod_conta)}`
                )
                .then((res) => {
                    this.listaRREOColuna= res.data;
                })
                .catch();
        },

        async fetchRGFColuna(search, loading) {
            loading(true);

            if (search != "") {
                this.variavelRGFColunaSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/certidoes/rgf-colunas/anexo/${encodeURIComponent(this.variavelRGFPoderSelecionada.value)}/${encodeURIComponent(this.variavelRGFPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRGFAnexoSelecionada.anexo)}/conta/${encodeURIComponent(this.variavelRGFContaSelecionada.cod_conta)}/${encodeURIComponent(search)}`
                    )
                    .then((res) => {
                        this.listaRGFColuna= res.data;
                    })
                    .catch();
            }

            loading(false);
        },

        async fetchRGFColunaVazio() {
            this.variavelRGFColunaSelecionada = null;
            await Nova.request()
                .get(
                    `/nova-vendor/nova-ckeditor/certidoes/rgf-colunas/anexo/${encodeURIComponent(this.variavelRGFPoderSelecionada.value)}/${encodeURIComponent(this.variavelRGFPeriodoSelecionada.value)}/${encodeURIComponent(this.variavelRGFAnexoSelecionada.anexo)}/conta/${encodeURIComponent(this.variavelRGFContaSelecionada.cod_conta)}`
                )
                .then((res) => {
                    this.listaRGFColuna= res.data;
                })
                .catch();
        },

        async fetchFormulas(search, loading) {
            loading(true);

            if (search != "") {
                this.formulaSelecionada = null;
                await Nova.request()
                    .get(
                        `/nova-vendor/nova-ckeditor/formulas/${escape(search)}`
                    )
                    .then((res) => {
                        this.listaFormulas = res.data;
                    })
                    .catch();
            }

            loading(false);
        },
    },
    created() {
        this.$options[this.editorUUID] = this.uuid();

        this.setInitialValue();
    },
    mounted() {
        if (this.currentlyIsVisible) {
            this.createCkEditor();
        }

        this.mounted = true;

        const baseYear = 2021;
        const currentYear = new Date().getFullYear();

        for (let year = currentYear; year >= baseYear; year--) {
            const numPreviousYears = currentYear - year;
            const usePluralForm = numPreviousYears > 1;
            const isCurrentYear = year === currentYear;
            const description = `Exercício${usePluralForm ? 's' : ''} Anterior${usePluralForm ? 'es' : ''}`;

            this.listaExercicio.push({
                label: isCurrentYear ? 'Exercício da Análise' : `${numPreviousYears} ${description}`,
                value: isCurrentYear ? 'Atual' : `Atual-${numPreviousYears}`
            });
        }

        this.exercicioContaGovernoSelecionada = this.listaExercicio[0];

        /** Limite em pixels partindo do topo */
        const limitFixedScroll = 550;
        window.addEventListener('scroll', () => {
            console.log(window.scrollY);
            
            if (window.scrollY > limitFixedScroll && !this.fixed) {
                this.fixed = true;
            } else if (window.scrollY <= limitFixedScroll - 100 && this.fixed) {
                this.fixed = false;
            }
        });
    },
    beforeUnmount() {
        this.destroyCkEditor();
    },
};
</script>

<style lang="sass">

.ck.ck-sticky-panel .ck-sticky-panel__content_sticky
    margin: 165px

.fixed-container
    position: sticky
    top: 0
    width: 100%
    z-index: 100
    height: 180px
    padding-top: 1px

.vs__dropdown-menu
    display: block
    box-sizing: border-box
    position: absolute
    top: calc(100% - 1px)
    left: 0
    z-index: 1000
    padding: 5px 0
    margin: 0
    max-width: 550px
    width: 550px
    min-width: 160px
    overflow-y: auto
    box-shadow: 0 3px 6px 0 rgba(0,0,0,.15)
    border: 1px solid rgba(60,60,60,.26)
    border-top-style: none
    border-radius: 0 0 4px 4px
    text-align: left
    list-style: none
    background: #fff

@import "../../sass/field"
</style>
