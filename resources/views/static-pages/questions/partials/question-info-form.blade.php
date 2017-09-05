<div class="ui readme markdown-body content-body">

    <div name="排版规范" data-unique="排版规范"></div>
    <h2 id="排版规范">排版规范<a href="#排版规范" class="anchorific">#</a></h2>
    <p>此文档遵循 <a href="https://github.com/sparanoid/chinese-copywriting-guidelines">中文排版指南</a> 规范，并在此之上遵守以下约定：</p>
    <ul>
        <li>英文的左右保持一个空白，避免中英文字黏在一起；</li>
        <li>使用全角标点符号；</li>
        <li>严格遵循 Markdown 语法；</li>
        <li>原文中的双引号（" "）请代换成中文的引号（「」符号怎么打出来见 <a href="http://zhihu.com/question/19755746/answer/27233392">这里</a>）；</li>
        <li>「<code>加亮</code>」和「<strong>加粗</strong>」和「[链接]()」都需要在左右保持一个空格。</li>
    </ul>

    <div name="命令行提示符" data-unique="命令行提示符"></div>
    <h2 id="命令行提示符">命令行提示符<a href="#命令行提示符" class="anchorific">#</a></h2>
    <p>在本书的教授过程中，我将使用 <code>$</code> 符号来作为命令行提示符，如：</p>
    <pre class=" language-bash"><code class=" language-bash">$ <span class="token keyword">echo</span> <span
                    class="token string">"Hello Laravel!"</span>
Hello Laravel<span class="token operator">!</span></code></pre>
    <p>带有 <code>$</code> 符号的第一行代码指的是我们在命令行端口中输入的命令 <code>echo "Hello Laravel!"</code>。<code>echo</code> 是 Unix
        系统中常用的输出命令，用于输出指定字符串。第二行的 <code>Hello Laravel!</code> 是运行命令后的输出信息。后面我们会使用这种风格来表示命令行的输入与输出，因此你在复制命令行的时候要注意不要把
        <code>$</code> 和输出信息也复制进去了。</p>
    <p>由于接下来的教程有时会在两个不同的机器环境上（本机环境和虚拟机环境，大部分情况下是在虚拟机环境上）来调用命令行输入，因此我们约定，在本机上调用的命令输入使用 <code>&gt;</code> 符号，在虚拟机上调用的命令使用
        <code>$</code> 符号。</p>
    <p>以下命令行运行在虚拟机里：</p>
    <pre class=" language-bash"><code class=" language-bash">$ <span class="token keyword">echo</span> <span
                    class="token string">"I am in VM!"</span>
I am <span class="token keyword">in</span> VM<span class="token operator">!</span></code></pre>
    <p>以下命令行运行在 <strong>主机</strong> 上：</p>
    <pre class=" language-bash"><code class=" language-bash"><span class="token operator">&gt;</span> <span
                    class="token keyword">echo</span> <span class="token string">"I am in Host Machine!"</span>
I am <span class="token keyword">in</span> Host Machine<span class="token operator">!</span></code></pre>
    <div name="相对文件路径" data-unique="相对文件路径"></div>
    <h2 id="相对文件路径">相对文件路径<a href="#相对文件路径" class="anchorific">#</a></h2>
    <p>针对每个人不同的工作环境，本书将统一默认为项目的根目录，而不是项目在文件系统中的完整路径。</p>
    <p>例如在我电脑中 <code>UsersController.php</code> 文件的完整路径为：</p>
    <pre class=" language-php"><code class="  language-php"><span class="token operator">/</span>Users<span
                    class="token operator">/</span>aufree<span class="token operator">/</span>Code<span
                    class="token operator">/</span>sample<span class="token operator">/</span>app<span
                    class="token operator">/</span>Http<span class="token operator">/</span>Controllers<span
                    class="token operator">/</span>UsersController<span
                    class="token punctuation">.</span>php</code></pre>
    <p>但在本书中，文件名路径参照的是项目的根目录，显示如下：</p>
    <pre class=" language-php"><code class="  language-php">app<span class="token operator">/</span>Http<span
                    class="token operator">/</span>Controllers<span class="token operator">/</span>UsersController<span
                    class="token punctuation">.</span>php</code></pre>
    <p>这样就能保证每个人看到的路径名称都一致了。</p>
    <div name="竖排'...'代码省略" data-unique="竖排'...'代码省略"></div>
    <h2 id="竖排--代码省略">竖排 '...' 代码省略<a href="#竖排--代码省略" class="anchorific">#</a></h2>
    <p>最后，为了保持文章的篇幅简洁，我会将一些不必要的代码使用竖排的 <code>.</code> 来代替，你在复制本文代码块的时候，切记不要将 <code>.</code> 也一同复制进去。演示代码如下：</p>
    <pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span
                        class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>
<span class="token punctuation">.</span>
<span class="token punctuation">.</span>
<span class="token punctuation">.</span>
<span class="token keyword">class</span> <span class="token class-name">UsersController</span> <span
                    class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">index</span><span
                    class="token punctuation">(</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$users</span> <span class="token operator">=</span> <span
                    class="token scope">User<span class="token punctuation">::</span></span><span
                    class="token function">all</span><span class="token punctuation">(</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token keyword">return</span> <span class="token function">view</span><span
                    class="token punctuation">(</span><span class="token string">'users.index'</span><span
                    class="token punctuation">,</span> <span class="token function">compact</span><span
                    class="token punctuation">(</span><span class="token string">'users'</span><span
                    class="token punctuation">)</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span>
        </code></pre>

    <div class="ui success message">
        <div class="ui list">
            <div class="item">
                <i class="folder open grey icon"></i>
                <div class="content"><span class="black-font">分类:</span> <span>编程语言</span></div>
            </div>
            <div class="item">
                <i class=" tags grey icon"></i>
                <div class="content"><span class="black-font">标签:</span>
                    <span class="info-labels">
                        <a href="">php</a>
                        <a href="">java</a>
                    </span>
                </div>
            </div>
            <div class="item">
                <i class="warning sign orange icon"></i>
                <div class="content"><span class="black-font">原创声明:</span> <span>如无特别说明，均为作者原创文章。未经允许，不得转载!</span></div>
            </div>
        </div>
    </div>
</div>