#include "as8.h"
void process(void *dataPtr)
{
	/*	Statements */
	printf("Data: %5d", *(int *)dataPtr);
	return;
}
int main(void) {

	MTREE* tree;
	tree = NULL;
	for (int i = 0; i <= 20; i++) {
		tree = buildTree(tree);
	}
	treeTraverse(tree, process);
}
