<template>
    <FieldWrapper >
  
      <div
        class="mt-4 md:mt-0 pb-5 px-6 md:px-8 w-full" 
      >
              <div class="flex flex-col md:flex-row">
                  
                  <div class="w-full md:w-1/2 md:py-1">
                  <strong class="block">Variável de Conta de Governo</strong>
                  </div>
                  <div class="w-full md:w-1/2 md:py-1">
                  <strong class="block">Variável de Conta de Gestão</strong>
                  </div>
                  <div class="w-full md:w-1/2 md:py-1">
                  <strong class="block">Fórmulas</strong>
                  </div>                
              </div>
              <div class="flex flex-col md:flex-row mb-4">
                  <div class="md:mt-0 w-full md:w-1/4 md:py-1 mr-4">
                      <v-select v-model="variavelContaGovernoSelecionada" :filterable="false" inputId="id" label="nome" :options="listaVariaveisContaGoverno" @search="fetchVariaveisContaGoverno"></v-select>
                  </div>
                  <div class="md:mt-0 w-full md:w-1/4 md:py-1">
                      <button @click="addVariavelContaGoverno()" class="shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900" type="button">
                          Adicionar Conta de Governo
                      </button>
                  </div>
  
                  <div class="md:mt-0 w-full md:w-1/4 md:py-1 mr-4">
                      <v-select v-model="variavelSelecionada" :filterable="false" inputId="id" label="nome" :options="listaVariaveis" @search="fetchVariaveis"></v-select>
                  </div>
                  <div class="md:mt-0 w-full md:w-1/4 md:py-1">
                      <button @click="addVariavel()" class="shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900" type="button">
                          Adicionar Conta de Gestão
                      </button>
                  </div>
  
                  <div class="md:mt-0 w-full md:w-1/4 md:py-1 mr-4">
                      <v-select v-model="formulaSelecionada" :filterable="false" inputId="id" label="nome" :options="listaFormulas" @search="fetchFormulas"></v-select>
                  </div>
                  <div class="md:mt-0 w-full md:w-1/4 md:py-1">
                      <button @click="addFormula()" class="shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900" type="button">
                          Adicionar Fórmula
                      </button>
                  </div>
              </div>
              
              
              <textarea ref="editor" class="hidden" :id="currentField.attribute" :class="errorClasses" :value="value" />
  
              <p v-if="currentField.helpText" v-html="currentField.helpText" class="help-text help-text mt-2" />
  
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
  
              <snippet-browser :field-key="$options[editorUUID]" :snippets="currentField.snippetBrowser" />
          
             
          </div>
      </FieldWrapper>
      </template>
  
  
  <script>
  import CkEditor from '../ckeditor/ckeditor'
  import SnippetBrowser from "./snippet-browser"
  import MediaBrowser from "./media-browser"
  import HasUUID from "./mixins/hasUUID"
  import {DependentFormField, HandlesValidationErrors} from 'laravel-nova'
  import debounce from 'lodash/debounce'
  import RegexParser from 'regex-parser'
  import vSelect from 'vue-select'
  
  
  
  export default {
      mixins: [DependentFormField, HandlesValidationErrors, HasUUID],
      props: ['resourceName', 'resourceId', 'field', 'toolbar', 'formUniqueId'],
      components: {SnippetBrowser, MediaBrowser, vSelect},
      data() {
          return {
              mounted: false,
              listaVariaveis: [],
              listaVariaveisContaGoverno: [],
              listaFormulas: [],
              variavelSelecionada: null,
              variavelContaGovernoSelecionada: null,
              formulaSelecionada: null,
  
              fieldName: { type: String },
              showErrors: { type: Boolean, default: true },
              fullWidthContent: { type: Boolean, default: false },
              labelFor: { default: null }
          }
      },
      computed: {
          editorName() {
              const attribute = this.currentField.attribute.toLowerCase().replace(/[^a-zA-Z0-9]+(.)/g, (m, chr) => chr.toUpperCase())
  
              return attribute + 'Editor' + this.formUniqueId;
          },
          fieldLabel() {
          // If the field name is purposefully an empty string, then let's show it as such
          if (this.fieldName === '') {
              return ''
          }
  
          return this.fieldName || this.field.name || this.field.singularLabel
          },
  
          /**
           * Determine help text should be shown.
           */
          shouldShowHelpText() {
          return this.showHelpText && this.field.helpText?.length > 0
          },
      },
      watch: {
          value(value) {
              this.emitFieldValueChange(this.currentField.attribute, value || '')
          },
  
          currentlyIsVisible(status) {
              if (status && this.mounted) {
                  setTimeout(this.createCkEditor, 5)
              }
          }
      },
      methods: {
          
          createCkEditor() {
              const toolbarOptions = this.initToolbarOptions(this.currentField.toolbarOptions)
              const headings = toolbarOptions.headings
              const image = toolbarOptions.image ?? CkEditor.defaultConfig.image
  
              delete toolbarOptions.headings
              delete toolbarOptions.image
  
              const config = {
                  attribute: this.$options[this.editorUUID],
                  imageBrowser: this.currentField.imageBrowser,
                  videoBrowser: this.currentField.videoBrowser,
                  audioBrowser: this.currentField.audioBrowser,
                  snippetBrowser: this.currentField.snippetBrowser,
                  htmlSupport: this.normalizeHtmlSupportItems(this.currentField.htmlSupport),
                  isReadOnly: this.currentField.readonly,
                  image: image,
                  language: {
                      ui: this.currentField.uiLanguage,
                      content: this.currentField.contentLanguage,
                      textPartLanguage: this.currentField.textPartLanguage
                  },
                  heading: {
                      options: headings,
                  },
                  toolbar: {
                      items: this.currentField.toolbar,
                      shouldNotGroupWhenFull: this.currentField.shouldNotGroupWhenFull
                  },
                  simpleUpload: {
                      ...CkEditor.defaultConfig.simpleUpload,
  
                      headers: {
                          ...CkEditor.defaultConfig.simpleUpload.headers,
                          'X-Toolbar':  this.currentField.toolbarName
                      },
                  },
                  ...toolbarOptions
              }
  
              CkEditor.create(this.$refs.editor, config)
                  .then((editor) => {
                      const {editing, model} = this.$options[this.editorName] = editor
  
                      // prevent question-mark & slash from triggering nova search
                      editing.view.document.on('keydown', this.handleEditorEvents, {
                          priority: 'highest'
                      })
  
                      // sync model changes to vue-model
                      model.document.on('change', debounce(this.handleEditorSync, 100), {
                          priority: 'lowest'
                      })
  
                      editor.editing.view.change((writer) => {
                          // set the height of the editor when editing
                          if (this.currentField.height > 1) {
                              writer.setStyle('height', `${this.currentField.height}px`, editor.editing.view.document.getRoot());
                          }
  
                          this.editorResizeFix(editor, writer)
                      });
  
  
                      if (this.currentField.readonly) {
                          editor.enableReadOnlyMode(this.$options[this.editorUUID]);
                      }
                  })
                  .catch((e) => {
                      console.log(e)
                      Nova.error(e.toString())
                  })
          },
  
          destroyCkEditor() {
              if (this.$options[this.editorName]) {
                  this.$options[this.editorName]
                      .destroy()
                      .then(() => this.$options[this.editorName] = null)
                      .catch((e) => Nova.error(e.toString()))
              }
          },
  
          setInitialValue() {
              this.value = this.currentField.value || ''
          },
  
          initToolbarOptions(toolbarOptions) {
              if (toolbarOptions.mediaEmbed) {
                  if (toolbarOptions.mediaEmbed.providers) {
                      toolbarOptions.mediaEmbed.providers = this.normalizeMediaEmbedToolbarOptions(toolbarOptions.mediaEmbed.providers)
                  }
                  if (toolbarOptions.mediaEmbed.extraProviders) {
                      toolbarOptions.mediaEmbed.extraProviders = this.normalizeMediaEmbedToolbarOptions(toolbarOptions.mediaEmbed.extraProviders)
                  }
              }
  
              return toolbarOptions
          },
  
          normalizeMediaEmbedToolbarOptions(providers) {
              if (providers && Array.isArray(providers)) {
                  for (let i = 0; i < providers.length; i++) {
                      const url = providers[i]?.url ?? null
                      const html = providers[i]?.html ?? null
  
                      if (Array.isArray(url)) {
                          const urls = url
  
                          for (let j = 0; j< urls.length; j++) {
                              urls[j] = RegexParser(urls[j])
                          }
  
                          providers[i].url = urls
                      }
                      else if (url) {
                          providers[i].url = RegexParser(url)
                      }
  
                      if (html) {
                          providers[i].html = (match) => eval('`' + html + '`')
                      }
                  }
              }
  
              return providers
          },
  
          normalizeHtmlSupportItems(htmlSupport) {
              if (htmlSupport) {
                  if (htmlSupport.allow) {
                      htmlSupport.allow.map(item => {
                          if (item.name) {
                              item.name = this.stringToRegex(item.name)
                          }
  
                          return item
                      })
                  }
                  else {
                      htmlSupport.allow = []
                  }
  
                  if (htmlSupport.disallow) {
                      htmlSupport.disallow.map(item => {
                          if (item.name) {
                              item.name = this.stringToRegex(item.name)
                          }
  
                          return item
                      })
                  }
                  else {
                      htmlSupport.disallow = []
                  }
  
                  return htmlSupport
              }
  
              return {
                  allow: [],
                  disallow: []
              }
          },
  
          stringToRegex(string) {
              if (typeof string === 'string' && string.startsWith('/') && string.endsWith('/')) {
                  const regexPattern = string.slice(1, -1)
  
                  return new RegExp(regexPattern)
              }
  
              return string
          },
  
          fill(formData) {
              if (this.currentlyIsVisible) {
                  formData.append(this.currentField.attribute, this.value || '')
              }
          },
  
          handleChange(value) {
              this.value = value
          },
  
          handleEditorEvents(event, data) {
              if (['Tab', '/'].includes(data.key) || [191, 9].includes(data.keyCode)) {
                  data.stopPropagation()
              }
          },
  
          handleEditorSync() {
              const editor = this.$options[this.editorName]
  
              if (editor) {
                  this.handleChange(editor.getData())
              }
          },
  
          // fix for keeping editor height on resize
          editorResizeFix(editor, writer) {
              const resizeObserver = new ResizeObserver(
                  debounce((element) => {
                      const height = element[0].target.offsetHeight
  
                      if (height > 10) {
                          writer.setStyle('height', `${height}px`, editor.editing.view.document.getRoot())
                      }
                  }, 100),
              )
  
              const innerEditor = editor.ui.view.element.getElementsByClassName('ck-editor__editable')
  
              if (innerEditor?.length) {
                  resizeObserver.observe(innerEditor[0])
              }
          },
  
          addVariavel() {
              const editor = this.$options[this.editorName]
              if (editor) {
                  editor.model.change( writer => {
                      const insertPosition = editor.model.document.selection.getFirstPosition();
  
                      const viewFragment = editor.data.processor.toView( '${'+this.variavelSelecionada.nome+'}' );
                      const modelFragment = editor.data.toModel( viewFragment );
                      editor.model.insertContent(modelFragment, insertPosition );
                  } );
              }
          },
  
          addVariavelContaGoverno() {
              const editor = this.$options[this.editorName]
              if (editor) {
                  editor.model.change( writer => {
                      const insertPosition = editor.model.document.selection.getFirstPosition();
  
                      const viewFragment = editor.data.processor.toView( '${'+this.variavelContaGovernoSelecionada.nome+'}' );
                      const modelFragment = editor.data.toModel( viewFragment );
                      editor.model.insertContent(modelFragment, insertPosition );
                  } );
              }
          },
  
          addFormula() {
              const editor = this.$options[this.editorName]
              if (editor) {
                  editor.model.change( writer => {
                      const insertPosition = editor.model.document.selection.getFirstPosition();
                      
                      const viewFragment = editor.data.processor.toView( '==('+this.formulaSelecionada.formula+')' );
                      const modelFragment = editor.data.toModel( viewFragment );
                      editor.model.insertContent(modelFragment, insertPosition );
                  } );
              }
          },
  
          /**
           * Triggered when the search text changes.
           *
           * @param search  {String}    Current search text
           * @param loading {Function}	Toggle loading class
           */
          async fetchVariaveis (search, loading) {
              loading(true);
              
              if (search != '') {
                  this.variavelSelecionada = null;
                  await Nova.request()
                  .get(`/nova-vendor/nova-ckeditor/variaveis/${escape(search)}`)
                  .then(res => { 
                      this.listaVariaveis = res.data;
                  })
                  .catch();
              }
                  
              loading(false);
          },
  
          async fetchVariaveisContaGoverno (search, loading) {
              loading(true);
              
              if (search != '') {
                  this.variavelContaGovernoSelecionada = null;
                  await Nova.request()
                  .get(`/nova-vendor/nova-ckeditor/variaveisContaGoverno/${escape(search)}`)
                  .then(res => { 
                      this.listaVariaveisContaGoverno = res.data;
                  })
                  .catch();
              }
                  
              loading(false);
          },
  
  
          async fetchFormulas (search, loading) {
              loading(true);
              
              if (search != '') {
                  this.formulaSelecionada = null;
                  await Nova.request()
                  .get(`/nova-vendor/nova-ckeditor/formulas/${escape(search)}`)
                  .then(res => { 
                      this.listaFormulas = res.data;
                  })
                  .catch();
              }
                  
              loading(false);
          }
      },
      created() {
          this.$options[this.editorUUID] = this.uuid()
  
          this.setInitialValue()
      },
      mounted() {
          if (this.currentlyIsVisible) {
              this.createCkEditor()
          }
  
          this.mounted = true
      },
      beforeUnmount() {
          this.destroyCkEditor()
      }
  }
  </script>
  
  <style lang="sass">
  .ck.ck-reset_all, .ck.ck-reset_all *
      // direction: ltr !important
  
  .ck-content.ck-editor__editable
      resize: vertical
  
  .ck.ck-reset.ck-editor
      .ck.ck-toolbar
          border-radius: 10px 10px 0 0
  
      .ck-editor__editable_inline
          border-radius: 0 0 10px 10px
          margin: 0
          padding: 0 10px
          @import "../../sass/field"
  
      .ck.ck-editor__editable:not(.ck-editor__nested-editable).ck-focused
          box-shadow: none
  </style>
  